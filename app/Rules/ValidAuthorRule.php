<?php

namespace App\Rules;

use App\Models\Author;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class ValidAuthorRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_array($value)) {
            $fail(':attribute deve ser uma lista.');
        }

        $numericAuthors = [];

        foreach ($value as $author) {
            if (is_numeric($author)) {
                $numericAuthors[] = $author;
                continue;
            }

            if (!is_array($author) || !array_key_exists('name', $author)) {
                $fail(':attribute deve ter um nome.');
            }

            $authorExists = Author::where('name', $author)->exists();
            if ($authorExists) {
                $fail(':attribute contém uma tentativa de cadastrar um autor já cadastrado.');
            }
        }

        $authors = DB::table('authors')->whereIn('id', $numericAuthors)->count();
        if ($authors != count($numericAuthors)) {
            $fail(':attribute contém identificadores inválidos.');
        }
    }
}
