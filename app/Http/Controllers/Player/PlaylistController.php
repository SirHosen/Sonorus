<?php
// app/Http/Controllers/Player/PlaylistController.php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PlaylistController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:user']);
        $this->authorizeResource(Playlist::class, 'playlist');
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

        try {
            $data = $request->except('cover_image');
            $data['user_id'] = auth()->id();

            if ($request->hasFile('cover_image')) {
                $coverPath = $request->file('cover_image')->store('playlists/covers', 'public');
                $data['cover_image'] = $coverPath;
            }

            Playlist::create($data);

            return redirect()->route('player.playlists.index')
                ->with('success', 'Playlist created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating playlist: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create playlist. Please try again.');
        }
    }

    public function show(Playlist $playlist)
    {
        $playlist->load('songs.composer');
        return view('player.playlists.show', compact('playlist'));
    }

    public function edit(Playlist $playlist)
    {
        return view('player.playlists.edit', compact('playlist'));
    }

    public function update(Request $request, Playlist $playlist)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $data = $request->except('cover_image');

            if ($request->hasFile('cover_image')) {
                // Delete old cover image
                if ($playlist->cover_image) {
                    try {
                        Storage::disk('public')->delete($playlist->cover_image);
                    } catch (\Exception $e) {
                        Log::warning('Failed to delete old cover image: ' . $e->getMessage());
                    }
                }
                
                $coverPath = $request->file('cover_image')->store('playlists/covers', 'public');
                $data['cover_image'] = $coverPath;
            }

            $playlist->update($data);

            return redirect()->route('player.playlists.index')
                ->with('success', 'Playlist updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating playlist: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update playlist. Please try again.');
        }
    }

    public function destroy(Playlist $playlist)
    {
        try {
            // Delete cover image
            if ($playlist->cover_image) {
                try {
                    Storage::disk('public')->delete($playlist->cover_image);
                } catch (\Exception $e) {
                    Log::warning('Failed to delete cover image: ' . $e->getMessage());
                }
            }
            
            $playlist->delete();

            return redirect()->route('player.playlists.index')
                ->with('success', 'Playlist deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting playlist: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Failed to delete playlist. Please try again.');
        }
    }

    public function addSong(Request $request, Playlist $playlist)
    {
        $this->authorize('manageSongs', $playlist);

        $request->validate([
            'song_id' => 'required|exists:songs,id',
        ]);

        try {
            DB::beginTransaction();

            // Check if song already exists in playlist
            if ($playlist->songs->contains($request->song_id)) {
                DB::rollBack();
                return redirect()->back()->with('info', 'Song is already in the playlist.');
            }

            // Get the highest order value with lock
            $maxOrder = $playlist->songs()->lockForUpdate()->max('order') ?? 0;
            
            // Attach the song with the next order value
            $playlist->songs()->attach($request->song_id, ['order' => $maxOrder + 1]);
            
            DB::commit();
            return redirect()->back()->with('success', 'Song added to playlist successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error adding song to playlist: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add song to playlist. Please try again.');
        }
    }

    public function removeSong(Request $request, Playlist $playlist)
    {
        $this->authorize('manageSongs', $playlist);

        $request->validate([
            'song_id' => 'required|exists:songs,id',
        ]);

        try {
            $playlist->songs()->detach($request->song_id);
            
            return redirect()->back()->with('success', 'Song removed from playlist successfully!');
        } catch (\Exception $e) {
            Log::error('Error removing song from playlist: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to remove song. Please try again.');
        }
    }

    public function reorderSongs(Request $request, Playlist $playlist)
    {
        $this->authorize('manageSongs', $playlist);

        $request->validate([
            'song_ids' => 'required|array',
            'song_ids.*' => 'exists:songs,id',
        ]);

        try {
            DB::beginTransaction();

            // Get all song IDs currently in the playlist
            $playlistSongIds = $playlist->songs()->pluck('songs.id')->toArray();
            
            // Validate that all provided song_ids belong to this playlist
            $invalidSongIds = array_diff($request->song_ids, $playlistSongIds);
            if (!empty($invalidSongIds)) {
                DB::rollBack();
                return response()->json(['success' => false, 'message' => 'Some songs do not belong to this playlist.'], 400);
            }

            // Update the order of songs
            foreach ($request->song_ids as $index => $songId) {
                $playlist->songs()->updateExistingPivot($songId, ['order' => $index + 1]);
            }
            
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error reordering songs: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Failed to reorder songs.'], 500);
        }
    }
}
