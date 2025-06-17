<?php
// app/Http/Controllers/Player/PlaylistController.php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaylistController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:user']);
    }

    public function index()
    {
        $playlists = auth()->user()->playlists;
        return view('player.playlists.index', compact('playlists'));
    }

    public function create()
    {
        return view('player.playlists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('cover_image');
        $data['user_id'] = auth()->id();

        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('playlists/covers', 'public');
            $data['cover_image'] = $coverPath;
        }

        Playlist::create($data);

        return redirect()->route('player.playlists.index')
            ->with('success', 'Playlist created successfully!');
    }

    public function show(Playlist $playlist)
    {
        // Check if the playlist belongs to the current user
        if ($playlist->user_id !== auth()->id()) {
            abort(403);
        }

        $playlist->load('songs.composer');
        return view('player.playlists.show', compact('playlist'));
    }

    public function edit(Playlist $playlist)
    {
        // Check if the playlist belongs to the current user
        if ($playlist->user_id !== auth()->id()) {
            abort(403);
        }

        return view('player.playlists.edit', compact('playlist'));
    }

    public function update(Request $request, Playlist $playlist)
    {
        // Check if the playlist belongs to the current user
        if ($playlist->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('cover_image');

        if ($request->hasFile('cover_image')) {
            // Delete old cover image
            if ($playlist->cover_image) {
                Storage::disk('public')->delete($playlist->cover_image);
            }
            
            $coverPath = $request->file('cover_image')->store('playlists/covers', 'public');
            $data['cover_image'] = $coverPath;
        }

        $playlist->update($data);

        return redirect()->route('player.playlists.index')
            ->with('success', 'Playlist updated successfully!');
    }

    public function destroy(Playlist $playlist)
    {
        // Check if the playlist belongs to the current user
        if ($playlist->user_id !== auth()->id()) {
            abort(403);
        }

        // Delete cover image
        if ($playlist->cover_image) {
            Storage::disk('public')->delete($playlist->cover_image);
        }
        
        $playlist->delete();

        return redirect()->route('player.playlists.index')
            ->with('success', 'Playlist deleted successfully!');
    }

    public function addSong(Request $request, Playlist $playlist)
    {
        // Check if the playlist belongs to the current user
        if ($playlist->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'song_id' => 'required|exists:songs,id',
        ]);

        // Check if song already exists in playlist
        if (!$playlist->songs->contains($request->song_id)) {
            // Get the highest order value
            $maxOrder = $playlist->songs()->max('order') ?? 0;
            
            // Attach the song with the next order value
            $playlist->songs()->attach($request->song_id, ['order' => $maxOrder + 1]);
            
            return redirect()->back()->with('success', 'Song added to playlist successfully!');
        }

        return redirect()->back()->with('info', 'Song is already in the playlist.');
    }

    public function removeSong(Request $request, Playlist $playlist)
    {
        // Check if the playlist belongs to the current user
        if ($playlist->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'song_id' => 'required|exists:songs,id',
        ]);

        $playlist->songs()->detach($request->song_id);
        
        return redirect()->back()->with('success', 'Song removed from playlist successfully!');
    }

    public function reorderSongs(Request $request, Playlist $playlist)
    {
        // Check if the playlist belongs to the current user
        if ($playlist->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'song_ids' => 'required|array',
            'song_ids.*' => 'exists:songs,id',
        ]);

        // Update the order of songs
        foreach ($request->song_ids as $index => $songId) {
            $playlist->songs()->updateExistingPivot($songId, ['order' => $index + 1]);
        }
        
        return response()->json(['success' => true]);
    }
}
