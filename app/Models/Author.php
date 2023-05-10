<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';

    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'book_user_pivot',
            'author_id',
            'user_id'
        );
    }

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(
            Book::class,
            'book_author_pivot',
            'author_id',
            'book_id'
        );
    }
}
