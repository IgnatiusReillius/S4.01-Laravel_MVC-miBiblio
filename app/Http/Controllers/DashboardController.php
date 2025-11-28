<?php

namespace App\Http\Controllers;

use App\Models\BookUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        //return auth()->id();
        $booksUser = BookUser::with('book')
            ->where('user_id', Auth::user()->id)
            ->get();
        //printf($booksUser);
        return view('dashboard', compact('booksUser'));
    }
}
