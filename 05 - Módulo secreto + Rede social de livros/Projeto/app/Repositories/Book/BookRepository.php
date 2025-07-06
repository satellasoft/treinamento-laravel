<?php

namespace App\Repositories\Book;

use App\Models\Book;
use App\Repositories\Contracts\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    public function create(array $data): bool
    {
        $book = new Book();

        $book->fill($data);

        return $book->save();
    }
}
