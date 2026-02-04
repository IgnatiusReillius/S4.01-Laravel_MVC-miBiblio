<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'publisher',
        'publish_date',
        'pages',
        'summary',
        'cover_path'
    ];

    protected $casts = [
        'publish_date' => 'date',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'book_user', 'book_id', 'user_id')
                    ->withPivot('add_date', 'read_date', 'comment', 'rating')
                    ->withTimestamps();
    }

    public function bookUser()
    {
        return $this->hasMany(BookUser::class, 'book_id');
    }
}
