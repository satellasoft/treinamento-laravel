<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface BookRepositoryInterface
{
    public function create(array $data): bool;
    public function getAllPaginated(int $userID, int $perPage = 10);
    public function update(int $id, array $data): bool;
    public function deleteByUserID(int $bookId, int $userID): bool;
    public function findByUserID(int $bookId, int $userID);
}
