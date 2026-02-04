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

    public function edit(BookUser $bookUser) {

        return view('Book.book_edit', ['book' => $bookUser->book, 'bookUser' => $bookUser]);
    }

    public function update(Request $request, Book $book) {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'publish_date' => 'nullable|date',
            'pages' => 'nullable|integer|min:1',
            'isbn' => 'required|string|max:20',
            'summary' => 'nullable|string|max:1000',
            'cover_path' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
        ]);

        $data = [
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'publish_date' => $request->publish_date,
            'pages' => $request->pages,
            'isbn' => $request->isbn,
            'summary' => $request->summary,
        ];

        if ($request->hasFile('cover_path')) {
            if ($book->cover_path && file_exists(public_path($book->cover_path))) {
                unlink(public_path($book->cover_path));
            }

            $file = $request->file('cover_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            $data['cover_path'] = 'images/' . $filename;
        }

        $book->update($data);

        $bookUser = $book->bookUser()
            ->where('user_id', auth()->id())
            ->first();

        return redirect()->route('bookUser.show', $bookUser)
            ->with('success', 'Libro editado correctamente.');
    }

    public function destroy(Book $book) {

        $otherUsersCount = $book->bookUser()
                                ->where('user_id', '!=', auth()->id())
                                ->count();
        
        if ($otherUsersCount > 0) {
            return redirect()->route('dashboard')
                ->with('error', 'No se puede eliminar este libro porque otros usuarios tienen reseñas del mismo.');
        }
        
        $book->bookUser()
            ->where('user_id', auth()->id())
            ->delete();
        
        $book->delete();
        
        return redirect()->route('dashboard')
            ->with('success', 'Libro eliminado correctamente de la base de datos.');
    }
}
