<?php

namespace App\Rules;

use App\Models\Book;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BookExists implements ValidationRule
{

    private $bookID;

    public function __construct(string|int $id)
    {
        $this->bookID = $id;
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $book = Book::find($this->bookID);
        if (empty($book)) {
            $fail(':attribute não existe.');
        }
    }
}
