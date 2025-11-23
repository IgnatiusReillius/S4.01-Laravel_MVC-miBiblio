<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Display the specified resource.
    public function show($id) {
        $book = Book::find($id);
        return view('book.book', compact('book'));
    }
}
