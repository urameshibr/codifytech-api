<?php

namespace App\Traits;

use App\Repositories\BookRepository;

trait UsesBookRepository
{
    protected BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }
}
