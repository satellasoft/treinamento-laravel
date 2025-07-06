<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;
    private BookRepositoryInterface $bookRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        BookRepositoryInterface $bookRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->bookRepository = $bookRepository;
    }

    public function index()
    {
        $books = $this->bookRepository->getAllPaginated(2);

        return view('dashboard.index', [
            'categories' => $this->categoryRepository->getAll(),
            'books' => $books
        ]);
    }
}
