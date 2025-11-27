<?php

namespace App\Models;

use App\Enums\BookUserProperty;
use App\Enums\BookUserState;
use Illuminate\Database\Eloquent\Model;

class BookUser extends Model
{
    protected $table = 'book_user';

    public $incrementing = true; 

    protected $fillable = [
        'user_id',
        'book_id',
        'add_date',
        'read_date',
        'comment',
        'rating',
        'state',
        'property',
    ];

    protected $casts = [
        'add_date' => 'date',
        'read_date' => 'date',
        'state'     => BookUserState::class,
        'rating' => 'integer',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function book() {
        return $this->belongsTo(Book::class);
    }
}
