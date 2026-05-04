<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Show the wallet page.
     */
    public function index()
    {
        return view('user.wallet', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Add funds to the wallet (simulation).
     */
    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1|max:10000',
        ]);

        $user = auth()->user();
        $user->balance += $request->amount;
        $user->save();

        return redirect()->back()->with('success', 'Success! $' . number_format($request->amount, 2) . ' added to your account.');
    }
}
