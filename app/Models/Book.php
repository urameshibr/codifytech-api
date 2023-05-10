<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'title',
        'page_amount',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'book_user_pivot',
            'book_id',
            'user_id'
        );
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(
            Author::class,
            'book_author_pivot',
            'book_id',
            'author_id'
        );
    }
}
