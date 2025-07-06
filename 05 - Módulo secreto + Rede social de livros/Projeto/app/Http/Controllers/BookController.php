<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Requests\Book\UpdateCoverBookRequest;
use App\Models\Book;
use App\Repositories\Contracts\BookRepositoryInterface;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function store(StoreBookRequest $request)
    {
        $form = $request->validated();

        if (isset($form[Book::FAVORITE]) && $form[Book::FAVORITE] == 'on') {
            $form[Book::FAVORITE] = true;
        } else {
            $form[Book::FAVORITE] = false;
        }

        if (isset($form[Book::COMPLETE]) && $form[Book::COMPLETE] == 'on') {
            $form[Book::COMPLETE] = true;
        } else {
            $form[Book::COMPLETE] = false;
        }

        $form['user_id'] = Auth::user()->id;

        if (isset($form['cover'])) {
            $imageUploadService = new ImageUploadService('public');

            $filename = $imageUploadService->upload(
                $request->file('cover'),
                env('BOOK_DIR_UPLOAD')
            );

            if (!empty($filename)) {
                $form['cover'] = $filename;
            }
        }

        if (!$this->bookRepository->create($form)) {
            return redirect()->back()->withErrors([
                'Houve um erro ao tentar fazer o post. Por favor, tente novamente.'
            ]);
        }

        return redirect()->back()->with('success', 'Post criado com sucesso!');
    }

    public function update(UpdateBookRequest $request, int $bookId)
    {
        $form = $request->validated();

        if (isset($form[Book::FAVORITE]) && $form[Book::FAVORITE] == 'on') {
            $form[Book::FAVORITE] = true;
        } else {
            $form[Book::FAVORITE] = false;
        }

        if (isset($form[Book::COMPLETE]) && $form[Book::COMPLETE] == 'on') {
            $form[Book::COMPLETE] = true;
        } else {
            $form[Book::COMPLETE] = false;
        }

        $updated = $this->bookRepository->update($bookId, $form);

        if (!$updated) {
            return redirect()->back()->withErrors([
                'Houve um erro ao tentar alterar a postagem. Por favor, tente novamente.'
            ]);
        }

        return redirect()->back()->with('success', 'Postagem alterada com sucesso!');
    }

    public function delete(int $bookID)
    {
        $userID = Auth::user()->id;

        $cover = null;

        $book = $this->bookRepository->findByUserID($bookID, $userID);

        if (isset($book->cover)) {
            $cover = $book->cover;
        }

        $deleted = $this->bookRepository->deleteByUserID($bookID, $userID);

        if (!$deleted) {
            return redirect()->back()->withErrors([
                'Houve um erro ao tentar remover a postagem. Por favor, tente novamente.'
            ]);
        }

        if ($cover) {
            $imageUploadService = new ImageUploadService('public');
            $imageUploadService->delete($cover, env('BOOK_DIR_UPLOAD'));
        }

        return redirect()->back()->with('success', 'Postagem removida com sucesso!');
    }

    public function updatePhoto(UpdateCoverBookRequest $request, int $bookID)
    {
        $userID = Auth::user()->id;

        $book = $this->bookRepository->findByUserID($bookID, $userID);

        if (!$book) {
            return redirect()->back()->withErrors([
                'Não foi possível encontrar a postagem!'
            ]);
        }

        $legacyCover = $book->cover;

        $imageUploadService = new ImageUploadService('public');

        $filename = $imageUploadService->upload(
            $request->file('cover'),
            env('BOOK_DIR_UPLOAD')
        );

        $form = [
            'cover' => $filename
        ];

        if (!$this->bookRepository->update($bookID, $form)) {
            return redirect()->back()->withErrors([
                'Houve um erro ao tentar alterar a imagem. Por favor, tente novamente.'
            ]);
        }

        if (!empty($legacyCover)) {
            $imageUploadService->delete($legacyCover, env('BOOK_DIR_UPLOAD'));
        }

        return redirect()->back()->with('success', 'Postagem alterada com sucesso!');
    }
}
