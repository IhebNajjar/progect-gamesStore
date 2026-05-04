<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    // Browse all games with search and filters
    public function index(Request $request)
    {
        $query = Game::query();

        // Search by title
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by genre
        if ($request->has('genre') && $request->genre != 'all') {
            $query->where('genre', $request->genre);
        }

        // Filter by platform
        if ($request->has('platform') && $request->platform != 'all') {
            $query->where('platform', $request->platform);
        }

        $games = $query->get();
        return view('user.games.index', compact('games'));
    }

    // Single game page
    public function show(Game $game)
    {
        return view('user.games.show', compact('game'));
    }

    // Admin: Store a new game
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'platform' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        Game::create($request->all());

        return redirect()->back()->with('success', 'Game added successfully!');
    }

    // Admin: Update a game
    public function update(Request $request, Game $game)
    {
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'platform' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $game->update($request->all());

        return redirect()->back()->with('success', 'Game updated successfully!');
    }

    // Admin: Delete a game
    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->back()->with('success', 'Game deleted successfully!');
    }
}
