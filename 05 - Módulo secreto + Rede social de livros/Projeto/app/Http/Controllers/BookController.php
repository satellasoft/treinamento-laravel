<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\StoreBookRequest;
use App\Models\Book;
use App\Repositories\Contracts\BookRepositoryInterface;
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

        if (!$this->bookRepository->create($form)) {
            return redirect()->back()->withErrors([
                'Houve um erro ao tentar fazer o post. Por favor, tente novamente.'
            ]);
        }

        return redirect()->back()->with('success', 'Post criado com sucesso!');
    }
}
