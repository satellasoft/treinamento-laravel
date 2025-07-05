<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function create(array $data): bool;
    public function find(int $id) : object;
    public function update(int $id, array $data) : bool;
}
