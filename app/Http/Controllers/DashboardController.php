<?php

namespace App\Http\Controllers;

use App\Models\BookUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request) {

        $order = $request->get('order', 'title_asc');
        $category = $request->get('category', 'wishlist');

        $booksUserBase = BookUser::with('book')
            ->where('user_id', Auth::id())
            ->where('property', $category === 'owned' ? 1 : 0);

        $authors = $booksUserBase->clone()
            ->join('books', 'book_user.book_id', '=', 'books.id')
            ->select('books.author')
            ->distinct()
            ->pluck('books.author')
            ->filter()
            ->values();

        $publishers = $booksUserBase->clone()
            ->join('books', 'book_user.book_id', '=', 'books.id')
            ->select('books.publisher')
            ->distinct()
            ->pluck('books.publisher')
            ->filter()
            ->values();

        $ratings = $booksUserBase->clone()
            ->select('book_user.rating')
            ->distinct()
            ->pluck('rating')
            ->filter()
            ->values();

        $states = $booksUserBase->clone()
            ->select('book_user.state')
            ->distinct()
            ->pluck('state')
            ->filter()
            ->values();
        
        switch ($category) {
            case 'wishlist':
                $query = BookUser::with('book')
                    ->where('user_id', Auth::id())
                    ->where('book_user.property', 0)
                    ->join('books', 'book_user.book_id', '=', 'books.id');
                break;
            case 'owned':
                $query = BookUser::with('book')
                    ->where('user_id', Auth::id())
                    ->where('book_user.property', 1)
                    ->join('books', 'book_user.book_id', '=', 'books.id');
                break;
        }

        $booksUser = BookUser::with('book')
            ->where('user_id', Auth::user()->id)
            ->get();

        switch ($order) {
            case 'title_desc':
                $query->orderBy('books.title', 'desc');
                break;
            case 'author_asc':
                $query->orderBy('books.author', 'asc');
                break;
            case 'author_desc':
                $query->orderBy('books.author', 'desc');
                break;
            case 'pages_asc':
                $query->orderBy('books.pages', 'asc');
                break;
            case 'pages_desc':
                $query->orderBy('books.pages', 'desc');
                break;
            case 'date_asc':
                $query->orderBy('books.publish_date', 'asc');
                break;
            case 'date_desc':
                $query->orderBy('books.publish_date', 'desc');
                break;
            default:
                $query->orderBy('books.title', 'asc');
        }

        $selectedAuthor = $request->get('author');
        if ($selectedAuthor) {
            $query->where('books.author', $selectedAuthor);
        }

        $selectedPublisher = $request->get('publisher');
        if ($selectedPublisher) {
            $query->where('books.publisher', $selectedPublisher);
        }

        $selectedRating = $request->get('rating');
        if ($selectedRating) {
            $query->where('book_user.rating', $selectedRating);
        }

        $selectedState = $request->get('state');
        if ($selectedState) {
            $query->where('book_user.state', $selectedState);
        }

        $booksUser = $query->select('book_user.*')->get();

        return view('dashboard', compact('booksUser', 'order', 'category', 'authors', 'publishers', 'ratings', 'states'));
    }
}
