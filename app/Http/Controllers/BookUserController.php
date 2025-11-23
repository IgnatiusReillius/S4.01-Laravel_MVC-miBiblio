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
        return view('book.book_add', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $bookUser = BookUser::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'add_date' => now(),
        ]);

        return redirect()->route('dashboard');
            // ->with('success', 'Libro añadido correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(BookUser $bookUser)
    {
        // return $bookUser;
        $book = Book::find($bookUser->book->id);
        $bookUser = BookUser::find($bookUser->id);
        //return [$book, $bookUser];
        return view('book.book', ['book' => $book, 'bookUser' => $bookUser]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookUser $bookUser)
    {
        // return $bookUser;
        return view('Book.bookUser_edit', ['book' => $bookUser->book, 'bookUser' => $bookUser]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookUser $bookUser)
    {
        // return $bookUser;
        // return $request;
        $bookUser->update([
            'comment'   => $request->comment,
            'state'     => $request->state,
        ]);
        return view('book.book', ['book' => $bookUser->book, 'bookUser' => $bookUser]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookUser $bookUser)
    {
        //return $bookUser;
        $bookUser->delete();

        return redirect()->route('dashboard')
        ->with('success', 'Libro eliminado correctamente de tu biblioteca.');
    }

}
