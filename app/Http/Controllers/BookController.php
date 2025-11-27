<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookUser;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->fetchQuery;

        $userBookIds = BookUser::pluck('book_id');

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
