<?php

namespace App\Actions\Author;

use App\Repositories\AuthorRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ListAuthorsAction
{
    protected AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function __invoke(array $params = []): LengthAwarePaginator
    {
        return $this->authorRepository->getPaginated($params);
    }
}
