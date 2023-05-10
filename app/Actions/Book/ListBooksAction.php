<?php

namespace App\Actions\Book;

use App\Repositories\BookRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ListBooksAction
{
    protected BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function __invoke(): LengthAwarePaginator
    {
        return $this->bookRepository->getPaginated();
    }
}
