<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\BookRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Http\Resources\BookResource;
use Illuminate\Support\Facades\Auth;

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
        $userID = Auth::user()->id;
        $booksPaginator = $this->bookRepository->getAllPaginated($userID, 2);
        $booksResource = BookResource::collection($booksPaginator);

        return view('dashboard.index', [
            'categories' => $this->categoryRepository->getAll(),
            'books' => $booksResource->toArray(request()),
            'paginator' => $booksPaginator,
        ]);
    }
}
