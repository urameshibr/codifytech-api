<?php

namespace App\Actions\Book;

use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use Illuminate\Database\Eloquent\Model;

class StoreBookAction
{
    protected BookRepository $bookRepository;

    protected AuthorRepository $authorRepository;

    public function __construct(BookRepository $book_repository, AuthorRepository $author_repository)
    {
        $this->bookRepository = $book_repository;
        $this->authorRepository = $author_repository;
    }

    public function __invoke(array $data): Model
    {
        $book = $this->bookRepository->create($data);
        $hasAuthors = !empty($data['authors']);

        if ($hasAuthors) {
            foreach ($data['authors'] as &$author) {
                if (is_array($author)) {
                    $author = $this->authorRepository->create($author)->id;
                }
            }

            $book->authors()->attach($data['authors']);
        }

        if ($hasAuthors) {
            return $book->load('authors');
        }

        return $book;
    }
}
