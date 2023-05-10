<?php

namespace App\Actions\Book;

use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use Illuminate\Database\Eloquent\Model;

class UpdateBookAction
{
    protected BookRepository $bookRepository;

    protected AuthorRepository $authorRepository;

    public function __construct(BookRepository $book_repository, AuthorRepository $author_repository)
    {
        $this->bookRepository = $book_repository;
        $this->authorRepository = $author_repository;
    }

    public function __invoke(string|int $id, array $data): Model
    {
        $book = $this->bookRepository->find($id);
        if (empty($book)) {
            abort(422, 'Livro não encontrado');
        }

        $book = $this->bookRepository->update($book, $data);

        $hasAuthors = !empty($data['authors']);

        if ($hasAuthors) {
            foreach ($data['authors'] as &$author) {
                if (is_array($author)) {
                    $author = $this->authorRepository->create($author)->id;
                }
            }

            $book->authors()->sync($data['authors']);
        }

        if ($hasAuthors) {
            return $book->load('authors');
        }

        return $book;
    }
}
