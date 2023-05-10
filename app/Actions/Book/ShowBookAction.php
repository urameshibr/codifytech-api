<?php

namespace App\Actions\Book;

use App\Traits\UsesBookRepository;
use Illuminate\Database\Eloquent\Model;

class ShowBookAction
{
    use UsesBookRepository;

    public function __invoke(string|int $id, array $relations): ?Model
    {
        return $this->bookRepository->find($id, $relations);
    }
}
