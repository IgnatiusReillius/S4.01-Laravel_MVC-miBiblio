<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $hasBook = BookUser::where('user_id', Auth::id())->get();
        
        return view('book.book_add', compact('books', 'hasBook'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'property' => 'required|boolean'
        ]);
        
        $bookUser = BookUser::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'add_date' => now(),
            'property' => $request->property ?? 0,
        ]);

        return redirect()->route('dashboard', [
            'category' => $request->property == 1 ? 'owned' : 'wishlist'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(BookUser $bookUser)
    {
        
        $book = Book::find($bookUser->book->id);
        $bookUser = BookUser::find($bookUser->id);
        
        return view('book.book', ['book' => $book, 'bookUser' => $bookUser]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookUser $bookUser)
    {
        
        return view('Book.bookUser_edit', ['book' => $bookUser->book, 'bookUser' => $bookUser]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookUser $bookUser)
    {
        $bookUser->update([
            'add_date' => $request->add_date,
            'read_date' => $request->read_date,
            'comment'   => $request->comment,
            'state'     => $request->state,
            'property'  => $request->boolean('property'),
            'rating'    => $request->rating,
        ]);
        return view('book.book', ['book' => $bookUser->book, 'bookUser' => $bookUser]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookUser $bookUser)
    {
        $bookUser->delete();

        return redirect()->route('dashboard')
        ->with('success', 'Libro eliminado correctamente de tu biblioteca.');
    }

}
