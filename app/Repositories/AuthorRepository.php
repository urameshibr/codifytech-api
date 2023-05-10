<?php

namespace App\Repositories;

use App\Models\Author;

class AuthorRepository extends BaseRepository
{
    public function __construct()
    {
        $this->setModel(new Author);
    }
}
