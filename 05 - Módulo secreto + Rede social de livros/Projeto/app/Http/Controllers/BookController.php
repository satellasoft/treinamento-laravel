<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
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
}
