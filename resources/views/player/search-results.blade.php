<!-- resources/views/player/search-results.blade.php -->
@extends('layouts.player')

@section('title', 'Search Results for "' . $query . '"')

@section('content')
<div class="search-header mb-5">
    <div class="card">
        <div class="card-body p-4">
            <h4><i class="fas fa-search me-2"></i> Search Results for "{{ $query }}"</h4>
            <p class="text-muted">Found {{ $songs->total() }} songs and {{ $composers->total() }} composers</p>
        </div>
    </div>
</div>

@if($songs->count() == 0 && $composers->count() == 0)
    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i> No results found for "{{ $query }}". Try different keywords.
    </div>
@endif

@if($songs->count() > 0)
    <h3 class="section-title mb-4">Songs</h3>
    <div class="row">
        @foreach($songs as $song)
        <div class="col-md-3 mb-4">
            <div class="card song-card">
                <div class="image-wrapper">
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
        @endforeach
    </div>
    
    <div class="d-flex justify-content-center mt-4 mb-5">
        {{ $songs->appends(['query' => $query])->links() }}
    </div>
@endif

@if($composers->count() > 0)
    <h3 class="section-title mb-4 mt-5">Composers</h3>
    <div class="row">
        @foreach($composers as $composer)
        <div class="col-md-3 mb-4">
            <div class="card composer-card h-100" onclick="window.location.href='{{ route('player.composer', $composer) }}'">
                <div class="card-body text-center">
                    @if($composer->photo)
                        <img src="{{ asset('storage/' . $composer->photo) }}" alt="{{ $composer->name }}" class="mb-3">
                    @else
                        <img src="{{ asset('images/default-composer.jpg') }}" alt="{{ $composer->name }}" class="mb-3">
                    @endif
                    <h5>{{ $composer->name }}</h5>
                    <p class="text-muted mb-2">{{ $composer->birth_year ?? '?' }} - {{ $composer->death_year ?? 'Present' }}</p>
                    <p class="mb-3">{{ $composer->country ?? 'Unknown' }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-primary rounded-pill">{{ $composer->songs_count }} works</span>
                        <a href="{{ route('player.composer', $composer) }}" class="btn btn-sm btn-outline-light">
                            <i class="fas fa-music me-1"></i> View Works
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="d-flex justify-content-center mt-4">
        {{ $composers->appends(['query' => $query])->links() }}
    </div>
@endif
@endsection
