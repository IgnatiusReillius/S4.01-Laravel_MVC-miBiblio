<?php

namespace App\Models;

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

    public function user() {
        return $this->belongsTo(User::class);
    }
}
