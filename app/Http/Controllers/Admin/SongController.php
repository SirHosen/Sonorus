<?php
// app/Http/Controllers/Admin/SongController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Models\Composer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $songs = Song::with('composer')->orderBy('id')->paginate(10);
        return view('admin.songs.index', compact('songs'));
    }

    public function create()
    {
        $composers = Composer::orderBy('name')->get();
        return view('admin.songs.create', compact('composers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'composer_id' => 'required|exists:composers,id',
            'year' => 'nullable|string|max:10',
            'duration' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'audio_file' => 'required|file|mimes:mp3,wav,ogg|max:20480', // 20MB max
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['audio_file', 'cover_image']);

        // Handle audio file upload
        if ($request->hasFile('audio_file')) {
            $audioPath = $request->file('audio_file')->store('songs/audio', 'public');
            $data['audio_file'] = $audioPath;
        }

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('songs/covers', 'public');
            $data['cover_image'] = $imagePath;
        }

        Song::create($data);

        return redirect()->route('admin.songs.index')
            ->with('success', 'Song created successfully!');
    }

    public function show(Song $song)
    {
        return view('admin.songs.show', compact('song'));
    }

    public function edit(Song $song)
    {
        $composers = Composer::orderBy('name')->get();
        return view('admin.songs.edit', compact('song', 'composers'));
    }

    public function update(Request $request, Song $song)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'composer_id' => 'required|exists:composers,id',
            'year' => 'nullable|string|max:10',
            'duration' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'audio_file' => 'nullable|file|mimes:mp3,wav,ogg|max:20480', // 20MB max
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except(['audio_file', 'cover_image']);

        // Handle audio file upload
        if ($request->hasFile('audio_file')) {
            // Delete old audio file
            if ($song->audio_file) {
                Storage::disk('public')->delete($song->audio_file);
            }
            
            $audioPath = $request->file('audio_file')->store('songs/audio', 'public');
            $data['audio_file'] = $audioPath;
        }

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old cover image
            if ($song->cover_image) {
                Storage::disk('public')->delete($song->cover_image);
            }
            
            $imagePath = $request->file('cover_image')->store('songs/covers', 'public');
            $data['cover_image'] = $imagePath;
        }

        $song->update($data);

        return redirect()->route('admin.songs.index')
            ->with('success', 'Song updated successfully!');
    }

    public function destroy(Song $song)
    {
        // Delete audio file
        if ($song->audio_file) {
            Storage::disk('public')->delete($song->audio_file);
        }
        
        // Delete cover image
        if ($song->cover_image) {
            Storage::disk('public')->delete($song->cover_image);
        }
        
        $song->delete();

        return redirect()->route('admin.songs.index')
            ->with('success', 'Song deleted successfully!');
    }
}
