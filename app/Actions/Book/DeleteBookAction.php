<?php

namespace App\Actions\Book;

use App\Traits\UsesBookRepository;

class DeleteBookAction
{
    use UsesBookRepository;

    public function __invoke(string|int $id)
    {
        $book = $this->bookRepository->find($id);
        if (empty($book)) {
            abort(404, 'Livro não encontrado.');
        }

        $this->bookRepository->destroy($id);

        return $book;
    }
}
