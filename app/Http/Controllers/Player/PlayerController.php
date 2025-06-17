<?php
// app/Http/Controllers/Player/PlayerController.php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Models\Composer;
use App\Models\Playlist;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:user']);
    }

    public function index()
    {
        $recentSongs = Song::with('composer')->latest()->take(10)->get();
        $composers = Composer::withCount('songs')->orderBy('songs_count', 'desc')->take(6)->get();
        $playlists = auth()->user()->playlists;
        
        return view('player.index', compact('recentSongs', 'composers', 'playlists'));
    }

    public function browse()
    {
        $songs = Song::with('composer')->latest()->paginate(12);
        return view('player.browse', compact('songs'));
    }

    public function composers()
    {
        $composers = Composer::withCount('songs')->orderBy('name')->paginate(12);
        return view('player.composers', compact('composers'));
    }

    public function composerDetail(Composer $composer)
    {
        $composer->load('songs');
        return view('player.composer-detail', compact('composer'));
    }

    public function songDetail(Song $song)
    {
        $song->load('composer');
        $relatedSongs = Song::where('composer_id', $song->composer_id)
            ->where('id', '!=', $song->id)
            ->take(4)
            ->get();
            
        $userPlaylists = auth()->user()->playlists;
        
        return view('player.song-detail', compact('song', 'relatedSongs', 'userPlaylists'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $songs = Song::where('title', 'like', "%{$query}%")
            ->orWhereHas('composer', function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->with('composer')
            ->paginate(12);
            
        $composers = Composer::where('name', 'like', "%{$query}%")
            ->withCount('songs')
            ->paginate(12);
            
        return view('player.search-results', compact('songs', 'composers', 'query'));
    }
}
