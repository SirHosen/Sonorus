<!-- resources/views/player/index.blade.php -->
@extends('layouts.player')

@section('title', 'Welcome to Sonorus')

@section('content')
<div class="row mb-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-3">Welcome, {{ auth()->user()->name }}</h2>
                        <p class="lead mb-4">Embark on a journey through the timeless beauty of classical music. Discover masterpieces from legendary composers and immerse yourself in the rich tapestry of musical history.</p>
                        <div class="d-flex gap-3">
                            <a href="{{ route('player.browse') }}" class="btn btn-primary">
                                <i class="fas fa-music me-2"></i> Explore Music
                            </a>
                            <a href="{{ route('player.composers') }}" class="btn btn-outline-light">
                                <i class="fas fa-user-tie me-2"></i> Meet the Composers
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 text-center d-none d-md-block">
                        <img src="{{ asset('images/classical-illustration.png') }}" alt="Classical Music" class="img-fluid" style="max-height: 200px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<h3 class="section-title mb-4">Recently Added</h3>
<div class="row">
    @foreach($recentSongs as $song)
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
            <div class="card-body" onclick="window.location.href='{{ route('player.song', $song) }}'">
                <h5>{{ $song->title }}</h5>
                <p>{{ $song->composer->name }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>

<h3 class="section-title mb-4 mt-5">Featured Composers</h3>
<div class="row">
    @foreach($composers as $composer)
    <div class="col-md-2 mb-4">
        <div class="card composer-card" onclick="window.location.href='{{ route('player.composer', $composer) }}'">
            <div class="card-body">
                @if($composer->photo)
                    <img src="{{ asset('storage/' . $composer->photo) }}" alt="{{ $composer->name }}" class="mb-3">
                @else
                    <img src="{{ asset('images/default-composer.jpg') }}" alt="{{ $composer->name }}" class="mb-3">
                @endif
                <h5>{{ $composer->name }}</h5>
                <p>{{ $composer->songs_count }} compositions</p>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if($playlists->count() > 0)
<h3 class="section-title mb-4 mt-5">Your Playlists</h3>
<div class="row">
    @foreach($playlists as $playlist)
    <div class="col-md-3 mb-4">
        <div class="card song-card" onclick="window.location.href='{{ route('player.playlists.show', $playlist) }}'">
            <div class="position-relative">
                @if($playlist->cover_image)
                    <img src="{{ asset('storage/' . $playlist->cover_image) }}" alt="{{ $playlist->name }}">
                @else
                    <img src="{{ asset('images/default-playlist.jpg') }}" alt="{{ $playlist->name }}">
                @endif
                <div class="play-hover">
                    <i class="fas fa-play-circle"></i>
                </div>
            </div>
            <div class="card-body">
                <h5>{{ $playlist->name }}</h5>
                <p>{{ $playlist->songs->count() }} songs</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection
