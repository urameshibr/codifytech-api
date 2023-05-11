<?php

namespace App\Actions\Book;

use App\Repositories\BookRepository;
use App\Traits\UsesBookRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ListBooksAction
{
    use UsesBookRepository;

    public function __invoke(array $params = []): LengthAwarePaginator
    {
        return $this->bookRepository->getPaginated($params);
    }
}
