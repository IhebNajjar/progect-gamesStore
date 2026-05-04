<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function store(Request $request, Game $game)
    {
        // Check if game is in stock
        if ($game->stock <= 0) {
            return redirect()->back()->with('error', 'Sorry, this game is out of stock.');
        }

        // Create purchase record
        $user = auth()->user();

        // Check balance
        if ($user->balance < $game->price) {
            return redirect()->back()->with('error', 'Insufficient funds! You need $' . number_format($game->price - $user->balance, 2) . ' more.');
        }

        // Deduct balance
        $user->balance -= $game->price;
        $user->save();

        Purchase::create([
            'user_id' => $user->id,
            'game_id' => $game->id,
            'price_paid' => $game->price,
        ]);

        // Decrement stock
        $game->decrement('stock');

        return redirect()->route('dashboard')->with('success', 'You have successfully bought ' . $game->title);
    }
}
