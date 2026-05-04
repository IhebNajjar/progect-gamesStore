<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $purchases = Purchase::with('game')->where('user_id', $user->id)->get();
        $borrowings = Borrowing::with('game')->where('user_id', $user->id)->get();

        return view('user.dashboard', compact('purchases', 'borrowings'));
    }
}
