<!-- resources/views/player/playlists/show.blade.php -->
@extends('layouts.player')

@section('title', $playlist->name)

@section('styles')
<style>
    .song-list-item {
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 10px;
        background: rgba(30, 41, 59, 0.6);
        display: flex;
        align-items: center;
        transition: all 0.3s;
    }
    .song-list-item:hover {
        background: rgba(30, 41, 59, 0.9);
        transform: translateX(5px);
    }
    .song-list-item img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        margin-right: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .song-list-item .song-info {
        flex-grow: 1;
        width: auto;
    }
    .song-list-item .song-title {
        margin: 0;
        font-size: 16px;
        color: white;
    }
    .song-list-item .song-composer {
        margin: 5px 0 0;
        font-size: 14px;
        color: var(--light-gray);
    }
    .song-list-item .song-actions {
        display: flex;
        gap: 10px;
    }
    .sortable-ghost {
        opacity: 0.5;
        background: rgba(142, 68, 173, 0.2) !important;
    }
    .handle {
        cursor: grab;
        color: var(--light-gray);
        margin-right: 15px;
        font-size: 18px;
    }
    .playlist-header {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 30px;
    }
    .playlist-header-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-size: cover;
        background-position: center;
        filter: blur(20px);
        opacity: 0.3;
        z-index: 0;
    }
    .playlist-header-content {
        position: relative;
        z-index: 1;
        padding: 30px;
        display: flex;
        align-items: center;
    }
    .playlist-image {
        width: 200px;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        margin-right: 30px;
    }
    .playlist-info h2 {
        font-size: 32px;
        margin-bottom: 10px;
    }
    .playlist-actions {
        margin-top: 20px;
    }
</style>
@endsection

@section('content')
<div class="playlist-header">
    <div class="playlist-header-bg" style="background-image: url('{{ $playlist->cover_image ? asset('storage/' . $playlist->cover_image) : asset('images/default-playlist.jpg') }}');"></div>
    <div class="playlist-header-content">
        <img src="{{ $playlist->cover_image ? asset('storage/' . $playlist->cover_image) : asset('images/default-playlist.jpg') }}" alt="{{ $playlist->name }}" class="playlist-image">
        <div class="playlist-info">
            <h2>{{ $playlist->name }}</h2>
            <p>{{ $playlist->songs->count() }} songs</p>
            
            @if($playlist->description)
                <p>{{ $playlist->description }}</p>
            @endif
            
            <p class="text-muted">Created on {{ $playlist->created_at->format('F d, Y') }}</p>
            
            <div class="playlist-actions">
                @if($playlist->songs->count() > 0)
                    <button class="btn btn-primary" onclick="playPlaylist()">
                        <i class="fas fa-play me-2"></i> Play All
                    </button>
                @endif
                <a href="{{ route('player.playlists.edit', $playlist) }}" class="btn btn-outline-light ms-2">
                    <i class="fas fa-edit me-2"></i> Edit Playlist
                </a>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="section-title">Songs</h3>
    @if($playlist->songs->count() > 0)
        <button id="saveOrderBtn" class="btn btn-outline-light" style="display: none;">
            <i class="fas fa-save me-2"></i> Save Order
        </button>
    @endif
</div>

@if($playlist->songs->count() > 0)
    <div id="songList">
        @foreach($playlist->songs as $song)
        <div class="song-list-item" data-id="{{ $song->id }}">
            <i class="fas fa-grip-lines handle"></i>
            @if($song->cover_image)
                <img src="{{ asset('storage/' . $song->cover_image) }}" alt="{{ $song->title }}">
            @else
                <img src="{{ asset('images/default-cover.jpg') }}" alt="{{ $song->title }}">
            @endif
            <div class="song-info">
                <h5 class="song-title">{{ $song->title }}</h5>
                <p class="song-composer">{{ $song->composer->name }}</p>
            </div>
            <div class="song-actions">
                <button class="btn btn-sm btn-primary" onclick="playSong(
                    '{{ $song->id }}',
                    '{{ $song->title }}',
                    '{{ $song->composer->name }}',
                    '{{ $song->cover_image ? asset('storage/' . $song->cover_image) : asset('images/default-cover.jpg') }}',
                    '{{ asset('storage/' . $song->audio_file) }}'
                )">
                    <i class="fas fa-play"></i>
                </button>
                <form action="{{ route('player.playlists.remove-song', $playlist) }}" method="POST">
                    @csrf
                    <input type="hidden" name="song_id" value="{{ $song->id }}">
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Remove this song from the playlist?');">
                        <i class="fas fa-times"></i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i> This playlist is empty. Browse songs and add them to this playlist.
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('player.browse') }}" class="btn btn-primary">
            <i class="fas fa-music me-2"></i> Browse Songs
        </a>
    </div>
@endif
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
    // Initialize playlist songs for player
    const playlistSongs = [
        @foreach($playlist->songs as $song)
        {
            id: '{{ $song->id }}',
            title: '{{ $song->title }}',
            composer: '{{ $song->composer->name }}',
            cover: '{{ $song->cover_image ? asset('storage/' . $song->cover_image) : asset('images/default-cover.jpg') }}',
            url: '{{ asset('storage/' . $song->audio_file) }}'
        },
        @endforeach
    ];
    
    // Function to play the entire playlist
    function playPlaylist() {
        if (playlistSongs.length > 0) {
            const firstSong = playlistSongs[0];
            playSong(firstSong.id, firstSong.title, firstSong.composer, firstSong.cover, firstSong.url);
            
            // Override the playlist in the player
            window.playlist = playlistSongs;
            window.currentSongIndex = 0;
        }
    }
    
    // Initialize sortable for reordering songs
    document.addEventListener('DOMContentLoaded', function() {
        const songList = document.getElementById('songList');
        const saveOrderBtn = document.getElementById('saveOrderBtn');
        
        if (songList) {
            const sortable = new Sortable(songList, {
                handle: '.handle',
                animation: 150,
                ghostClass: 'sortable-ghost',
                onStart: function() {
                    saveOrderBtn.style.display = 'block';
                },
                onEnd: function() {
                    // Show save button when order changes
                    saveOrderBtn.style.display = 'block';
                }
            });
            
            // Save the new order
            saveOrderBtn.addEventListener('click', function() {
                saveOrderBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Saving...';
                saveOrderBtn.disabled = true;
                
                const songIds = Array.from(songList.children).map(item => item.dataset.id);
                
                fetch('{{ route('player.playlists.reorder', $playlist) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        song_ids: songIds
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        saveOrderBtn.style.display = 'none';
                        saveOrderBtn.innerHTML = '<i class="fas fa-save me-2"></i> Save Order';
                        saveOrderBtn.disabled = false;
                        
                        // Show success message
                        const alert = document.createElement('div');
                        alert.className = 'alert alert-success';
                        alert.innerHTML = '<i class="fas fa-check-circle me-2"></i> Playlist order saved successfully!';
                        document.querySelector('.content').insertBefore(alert, document.querySelector('.content').firstChild);
                        
                        // Remove alert after 3 seconds
                        setTimeout(() => {
                            alert.remove();
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    saveOrderBtn.innerHTML = '<i class="fas fa-save me-2"></i> Save Order';
                    saveOrderBtn.disabled = false;
                    
                    // Show error message
                    const alert = document.createElement('div');
                    alert.className = 'alert alert-danger';
                    alert.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i> An error occurred while saving the playlist order.';
                    document.querySelector('.content').insertBefore(alert, document.querySelector('.content').firstChild);
                });
            });
        }
    });
</script>
@endsection
