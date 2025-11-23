<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookUser;
use Illuminate\Http\Request;

class BookUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::all();
        return view('book.add_book', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::find($id);
        $bookUser = BookUser::find($id);
        // return [$book, $bookUser];
        return view('book.book', ['book' => $book, 'bookUser' => $bookUser]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book, BookUser $bookUser)
    {
        // return $bookUser;
        return view('Book.bookUser_edit', ['book' => $book, 'bookUser' => $bookUser]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookUser $bookUser)
    {
        
        $book = Book::find($bookUser->id);
        // return $book;
        // return $request;
        $bookUser->update([
            'comment'   => $request->comment,
            'state'     => $request->state,
        ]);
        return view('book.book', ['book' => $book, 'bookUser' => $bookUser]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookUser $bookUser)
    {
        //
    }
}
