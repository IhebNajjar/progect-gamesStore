<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    public function store(Request $request, Game $game)
    {
        // Check stock
        if ($game->stock <= 0) {
            return redirect()->back()->with('error', 'Sorry, this game is out of stock.');
        }

        // Calculate fee (10% of game price)
        $fee = $game->price * 0.10;

        // Determine user (Auth user or specified by admin)
        $userId = Auth::id();
        $spendingUser = Auth::user();

        if (Auth::user()->is_admin && $request->has('user_id')) {
            $userId = $request->user_id;
            $spendingUser = \App\Models\User::find($userId);
        }

        // Check balance
        if ($spendingUser->balance < $fee) {
            return redirect()->back()->with('error', 'Insufficient funds! User needs $' . number_format($fee - $spendingUser->balance, 2) . ' more.');
        }

        // Deduct balance
        $spendingUser->balance -= $fee;
        $spendingUser->save();

        // Create borrowing record
        Borrowing::create([
            'user_id' => $userId,
            'game_id' => $game->id,
            'fee' => $fee,
            'due_date' => Carbon::now()->addDays(7),
        ]);

        // Decrement stock
        $game->decrement('stock');

        return redirect()->route('dashboard')->with('success', 'Success! Borrowing fee: $' . number_format($fee, 2) . '. Please return ' . $game->title . ' by ' . Carbon::now()->addDays(7)->toFormattedDateString());
    }

    // Admin: Manual borrowing for a user
    public function manualStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'game_id' => 'required|exists:games,id',
        ]);

        $game = Game::findOrFail($request->game_id);

        // Check stock
        if ($game->stock <= 0) {
            return redirect()->back()->with('error', 'Sorry, this game is out of stock.');
        }

        $fee = $game->price * 0.10;
        $user = \App\Models\User::findOrFail($request->user_id);

        // Check balance
        if ($user->balance < $fee) {
            return redirect()->back()->with('error', 'Insufficient funds! User needs $' . number_format($fee - $user->balance, 2) . ' more.');
        }

        // Deduct balance
        $user->balance -= $fee;
        $user->save();

        Borrowing::create([
            'user_id' => $user->id,
            'game_id' => $game->id,
            'fee' => $fee,
            'due_date' => Carbon::now()->addDays(7),
        ]);

        $game->decrement('stock');

        return redirect()->back()->with('success', 'Borrowing created successfully for ' . $user->name . '. Fee: $' . number_format($fee, 2));
    }

    // Admin: Mark as returned
    public function returnGame(Borrowing $borrowing)
    {
        $borrowing->update([
            'returned_at' => Carbon::now(),
        ]);

        // Increment stock
        $borrowing->game->increment('stock');

        return redirect()->back()->with('success', 'Game marked as returned.');
    }
}
