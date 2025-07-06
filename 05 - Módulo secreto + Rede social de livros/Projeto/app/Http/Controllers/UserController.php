<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Requests\User\UpdatePassswordUserRequest;
use App\Http\Requests\User\UpdatePhotoUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserAccountResource;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterUserRequest $request)
    {
        $form = $request->validated();

        if (!$this->userRepository->create($form)) {
            return redirect()->back()->withErrors([
                'Houve um erro ao criar o usuário. Por favor, tente novamente.'
            ]);
        }

        return redirect()->back()->with('success', 'Usuário criado com sucesso!');
    }

    public function index()
    {
        $userResource  = new UserAccountResource(
            $this->userRepository->find(
                Auth::user()->id
            )
        );

        return view('user.account', [
            'user' => $userResource->toArray(request())
        ]);
    }

    public function update(UpdateUserRequest $request)
    {
        $userID = Auth::user()->id;

        if (!$this->userRepository->update($userID, $request->validated())) {
            return redirect()->back()->withErrors([
                'Houve um erro ao tentar alterar o usuário. Por favor, tente novamente.'
            ]);
        }

        return redirect()->back()->with('success', 'Dados do usuário alterado com sucesso!');
    }

    public function updatePassword(UpdatePassswordUserRequest $request)
    {
        $userID = Auth::user()->id;

        $form = [
            'password' => Hash::make($request->password)
        ];

        if (!$this->userRepository->update($userID, $form)) {
            return redirect()->back()->withErrors([
                'Houve um erro ao tentar alterar a senha. Por favor, tente novamente.'
            ]);
        }

        return redirect()->route('login.logout');
    }

    public function updatePhoto(UpdatePhotoUserRequest $request)
    {
        $imageUploadService = new ImageUploadService('public');

        $filename = $imageUploadService->upload(
            $request->file('photo'),
            env('USER_DIR_PROFILE_UPLOAD')
        );

        $form = [
            'photo' => $filename
        ];

        $currentPhoto = Auth::user()->photo;
        $userID = Auth::user()->id;

        if (!$this->userRepository->update($userID, $form)) {
            return redirect()->back()->withErrors([
                'Houve um erro ao tentar alterar a imagem do usuário. Por favor, tente novamente.'
            ]);
        }

        $imageUploadService->delete($currentPhoto, env('USER_DIR_PROFILE_UPLOAD'));

        return redirect()->back()->with('success', 'Imagem do usuário alterado com sucesso!');
    }
}
