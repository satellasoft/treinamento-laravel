<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function create(array $data): bool
    {
        return true;
    }

    public function getAll(): Collection
    {
        return Category::all();
    }
}
