<!-- resources/views/player/browse.blade.php -->
@extends('layouts.player')

@section('title', 'Browse Music')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <p class="text-muted">Showing {{ $songs->count() }} of {{ $songs->total() }} compositions</p>
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-sort me-2"></i> Sort By
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="sortDropdown">
                    <li><a class="dropdown-item" href="{{ route('player.browse', ['sort' => 'title']) }}">Title</a></li>
                    <li><a class="dropdown-item" href="{{ route('player.browse', ['sort' => 'composer']) }}">Composer</a></li>
                    <li><a class="dropdown-item" href="{{ route('player.browse', ['sort' => 'newest']) }}">Newest First</a></li>
                    <li><a class="dropdown-item" href="{{ route('player.browse', ['sort' => 'oldest']) }}">Oldest First</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @forelse($songs as $song)
    <div class="col-md-3 mb-4">
        <div class="card song-card">
            <div class="position-relative">
                @if($song->cover_image)
                    <img src="{{ asset('storage/' . $song->cover_image) }}" alt="{{ $song->title }}">
                @else
                    <img src="{{ asset('images/default-cover.jpg') }}" alt="{{ $song->title }}">
                @endif
                <div class="play-hover" onclick="playSong(
                    '{{ $song->id }}',
                    '{{ $song->title }}',
                    '{{ $song->composer->name }}',
                    '{{ $song->cover_image ? asset('storage/' . $song->cover_image) : asset('images/default-cover.jpg') }}',
                    '{{ asset('storage/' . $song->audio_file) }}'
                )">
                    <i class="fas fa-play-circle"></i>
                </div>
            </div>
            <div class="card-body">
                <h5>{{ $song->title }}</h5>
                <p>{{ $song->composer->name }}</p>
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-sm btn-primary" onclick="playSong(
                        '{{ $song->id }}',
                        '{{ $song->title }}',
                        '{{ $song->composer->name }}',
                        '{{ $song->cover_image ? asset('storage/' . $song->cover_image) : asset('images/default-cover.jpg') }}',
                        '{{ asset('storage/' . $song->audio_file) }}'
                    )">
                        <i class="fas fa-play me-1"></i> Play
                    </button>
                    <a href="{{ route('player.song', $song) }}" class="btn btn-sm btn-outline-light">Details</a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i> No songs available yet.
        </div>
    </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $songs->links() }}
</div>
@endsection
