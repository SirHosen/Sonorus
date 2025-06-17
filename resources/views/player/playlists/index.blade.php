<!-- resources/views/player/playlists/index.blade.php -->
@extends('layouts.player')

@section('title', 'My Playlists')

@section('content')
<div class="d-flex justify-content-end mb-4">
    <a href="{{ route('player.playlists.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i> Create New Playlist
    </a>
</div>

<div class="row">
    @forelse($playlists as $playlist)
    <div class="col-md-3 mb-4">
        <div class="card song-card h-100">
            <div class="position-relative">
                @if($playlist->cover_image)
                    <img src="{{ asset('storage/' . $playlist->cover_image) }}" alt="{{ $playlist->name }}">
                @else
                    <img src="{{ asset('images/default-playlist.jpg') }}" alt="{{ $playlist->name }}">
                @endif
                <div class="play-hover" onclick="window.location.href='{{ route('player.playlists.show', $playlist) }}'">
                    <i class="fas fa-play-circle"></i>
                </div>
            </div>
            <div class="card-body">
                <h5>{{ $playlist->name }}</h5>
                <p>{{ $playlist->songs->count() }} songs</p>
                <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('player.playlists.show', $playlist) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-play me-1"></i> Play
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-light dropdown-toggle" type="button" id="dropdownMenuButton{{ $playlist->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton{{ $playlist->id }}">
                            <li>
                                <a class="dropdown-item" href="{{ route('player.playlists.edit', $playlist) }}">
                                    <i class="fas fa-edit me-2"></i> Edit
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('player.playlists.destroy', $playlist) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this playlist?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-trash me-2"></i> Delete
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center p-5">
                <div class="mb-4">
                    <i class="fas fa-music fa-4x" style="color: var(--primary-color); opacity: 0.7;"></i>
                </div>
                <h4 class="mb-3">You don't have any playlists yet</h4>
                <p class="mb-4">Create your first playlist to start organizing your favorite classical pieces.</p>
                <a href="{{ route('player.playlists.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i> Create Playlist
                </a>
            </div>
        </div>
    </div>
    @endforelse
</div>
@endsection
