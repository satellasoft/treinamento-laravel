<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserAccountResource;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

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

    public function updatePassword(): bool
    {
        return true;
    }

    public function updatePhoto(): bool
    {
        return true;
    }
}
