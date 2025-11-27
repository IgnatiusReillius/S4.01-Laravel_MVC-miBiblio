<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Display the specified resource.
    public function show($id) {
    }

    public function create() {
    }

    public function add($id) {
        $addBook = Book::find($id);

    }
}
