<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(): void
    {
        $this->generateBooks(10);
        $this->generateAuthors(5);
        $this->setBookAuthors();
    }

    private function generateBooks(int $amount = 1)
    {
        Book::factory($amount)->create();
    }

    private function generateAuthors(int $amount)
    {
        Author::factory($amount)->create();
    }

    /**
     * @throws \Exception
     */
    private function setBookAuthors()
    {
        $authorIDs = Author::all()->pluck('id');
        $authorsCount = count($authorIDs);

        DB::beginTransaction();
        try {
            Book::all()->each(function (Book $book) use ($authorIDs, $authorsCount) {
                $authorIDs->shuffle();

                $linkedAuthorsAmount = rand(1, $authorsCount);
                $linkedIDs = $authorIDs->take($linkedAuthorsAmount);

                $book->authors()->attach($linkedIDs);
            });

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
