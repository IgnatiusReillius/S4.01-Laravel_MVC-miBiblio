<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookUser;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $request) {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|max:20|unique:books,isbn',
            'publisher' => 'nullable|string|max:255',
            'publish_date' => 'nullable|date',
            'pages' => 'nullable|integer|min:1',
            'summary' => 'nullable|string|max:1000',
            'cover_path' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        $coverPath = null;
        
        if ($request->hasFile('cover_path')) {
            $file = $request->file('cover_path');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('images'), $filename);

            $coverPath = 'images/' . $filename;
        }

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'publisher' => $request->publisher,
            'publish_date' => $request->publish_date,
            'pages' => $request->pages,
            'summary' => $request->summary,
            'cover_path' => $coverPath,
        ]);

        return redirect()->route('dashboard', [
            'category' => $request->property == 1 ? 'owned' : 'wishlist'
        ])
            ->with('success', 'Libro creado correctamente en la base de datos.');
    }
    
    public function search(Request $request)
    {
        $query = $request->fetchQuery;

        $userBookIds = BookUser::where('user_id', auth()->id())
                    ->pluck('book_id')
                    ->toArray();

        $books = Book::where('title', 'like', "%{$query}%")
                    ->orWhere('author', 'like', "%{$query}%")
                    ->limit(10)
                    ->get();
        
        return response()->json([
            'books' => $books,
            'userBooks' => $userBookIds
        ]);
    }
}
