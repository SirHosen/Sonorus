<?php
// app/Http/Controllers/Player/PlayerController.php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Models\Composer;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:user'])->except(['stream']);
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

    public function stream(Request $request, Song $song)
    {
        if (!$song->audio_file || !Storage::disk('public')->exists($song->audio_file)) {
            abort(404);
        }

        $path = Storage::disk('public')->path($song->audio_file);
        $size = filesize($path);
        $mime = Storage::disk('public')->mimeType($song->audio_file) ?: 'audio/mpeg';
        $headers = [
            'Content-Type' => $mime,
            'Accept-Ranges' => 'bytes',
        ];

        $range = $request->header('Range');
        if (!$range) {
            return response()->file($path, $headers);
        }

        if (!preg_match('/bytes=(\d+)-(\d*)/i', $range, $matches)) {
            return response()->file($path, $headers);
        }

        $start = (int) $matches[1];
        $end = $matches[2] !== '' ? (int) $matches[2] : $size - 1;
        if ($end >= $size) {
            $end = $size - 1;
        }

        if ($start > $end) {
            return response('', 416, ['Content-Range' => "bytes */{$size}"]);
        }

        $length = $end - $start + 1;
        $headers['Content-Range'] = "bytes {$start}-{$end}/{$size}";
        $headers['Content-Length'] = $length;

        return response()->stream(function () use ($path, $start, $length) {
            $handle = fopen($path, 'rb');
            if ($handle === false) {
                return;
            }

            fseek($handle, $start);
            $buffer = 8192;
            $remaining = $length;

            while ($remaining > 0 && !feof($handle)) {
                $read = $remaining > $buffer ? $buffer : $remaining;
                $data = fread($handle, $read);
                if ($data === false) {
                    break;
                }
                echo $data;
                $remaining -= strlen($data);

                if (connection_aborted()) {
                    break;
                }
            }

            fclose($handle);
        }, 206, $headers);
    }
}
