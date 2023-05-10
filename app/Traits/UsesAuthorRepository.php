<?php

namespace App\Traits;

use App\Repositories\AuthorRepository;

trait UsesAuthorRepository
{
    protected AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $author_repository)
    {
        $this->authorRepository = $author_repository;
    }
}
