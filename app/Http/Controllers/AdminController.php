<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Purchase;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the statistics and history (Admin Dashboard).
     */
    public function statistics()
    {
        $activeBorrowings = Borrowing::with(['user', 'game'])->whereNull('returned_at')->get();
        $salesHistory = Purchase::with(['user', 'game'])->latest()->get();

        return view('admin.statistics', [
            'activeBorrowings' => $activeBorrowings,
            'salesHistory' => $salesHistory,
            'users' => User::where('is_admin', false)->get(),
            'games' => Game::where('stock', '>', 0)->get(),
        ]);
    }

    /**
     * Display the user management page.
     */
    public function users(Request $request)
    {
        $query = User::where('is_admin', false);

        if ($request->has('user_search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user_search . '%')
                  ->orWhere('email', 'like', '%' . $request->user_search . '%');
            });
        }

        return view('admin.users', [
            'users' => $query->get(),
        ]);
    }

    /**
     * Display the game inventory management page.
     */
    public function games()
    {
        return view('admin.games', [
            'games' => Game::latest()->get(),
        ]);
    }

    /**
     * Display the user edit form.
     */
    public function editUser(User $user)
    {
        if ($user->is_admin) {
            return redirect()->route('admin.users')->with('error', 'Cannot edit admin users from here.');
        }

        return view('admin.edit_user', compact('user'));
    }

    /**
     * Update the user information.
     */
    public function updateUser(Request $request, User $user)
    {
        if ($user->is_admin) {
            return redirect()->route('admin.users')->with('error', 'Cannot edit admin users.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->address = $validated['address'];
        $user->city = $validated['city'];

        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    /**
     * Delete a non-admin user account.
     */
    public function deleteUser(User $user)
    {
        if ($user->is_admin) {
            return redirect()->back()->with('error', 'Cannot delete admin user.');
        }

        $user->delete();
        return redirect()->back()->with('success', 'User account deleted.');
    }
}
