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

    public function getAllPaginated(int $userID, int $perPage = 10)
    {
        return Book::where('user_id', $userID)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function update(int $id, array $data): bool
    {
        $book = Book::find($id);

        return $book->update($data);
    }
}
