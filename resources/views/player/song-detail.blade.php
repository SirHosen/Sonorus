<!-- resources/views/player/song-detail.blade.php -->
@extends('layouts.player')

@section('title', $song->title)

@section('content')
<div class="card mb-5">
    <div class="card-body p-4">
        <div class="row">
            <div class="col-md-4 text-center">
                @if($song->cover_image)
                    <img src="{{ asset('storage/' . $song->cover_image) }}" alt="{{ $song->title }}" class="img-fluid rounded mb-3" style="max-width: 300px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);">
                @else
                    <img src="{{ asset('images/default-cover.jpg') }}" alt="{{ $song->title }}" class="img-fluid rounded mb-3" style="max-width: 300px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);">
                @endif
                
                <div class="d-grid gap-2 mt-4">
                    <button class="btn btn-lg btn-primary" onclick="playSong(
                        '{{ $song->id }}',
                        '{{ $song->title }}',
                        '{{ $song->composer->name }}',
                        '{{ $song->cover_image ? asset('storage/' . $song->cover_image) : asset('images/default-cover.jpg') }}',
                        '{{ route('player.stream', $song) }}'
                    )">
                        <i class="fas fa-play me-2"></i> Play
                    </button>
                    
                    <div class="dropdown mt-2">
                        <button class="btn btn-outline-light dropdown-toggle w-100" type="button" id="addToPlaylistDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-plus me-2"></i> Add to Playlist
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark w-100" aria-labelledby="addToPlaylistDropdown">
                            @forelse($userPlaylists as $playlist)
                                <li>
                                    <form action="{{ route('player.playlists.add-song', $playlist) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="song_id" value="{{ $song->id }}">
                                        <button type="submit" class="dropdown-item">{{ $playlist->name }}</button>
                                    </form>
                                </li>
                            @empty
                                <li><span class="dropdown-item">No playlists yet</span></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('player.playlists.create') }}">
                                        Create a playlist
                                    </a>
                                </li>
                            @endforelse
                            
                            @if($userPlaylists->count() > 0)
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('player.playlists.create') }}">
                                        Create a new playlist
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="song-meta mb-4">
                    <h2 class="mb-2">{{ $song->title }}</h2>
                    <p class="mb-1">
                        <strong>Composer:</strong> 
                        <a href="{{ route('player.composer', $song->composer) }}" class="text-decoration-none" style="color: var(--primary-color);">
                            {{ $song->composer->name }}
                        </a>
                    </p>
                    <div class="d-flex gap-3 mt-3">
                        @if($song->year)
                            <div class="song-meta-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span class="text-light">{{ $song->year }}</span>
                            </div>
                        @endif
                        
                        @if($song->duration)
                            <div class="song-meta-item">
                                <i class="fas fa-clock"></i>
                                <span class="text-light">{{ $song->duration }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                
                @if($song->description)
                    <div class="song-description mb-4">
                        <h5 class="mb-3"><i class="fas fa-info-circle me-2"></i>About this Piece</h5>
                        <div class="p-3" style="background: rgba(255, 255, 255, 0.05); border-radius: 10px;">
                            <p class="text-light">{!! nl2br(e($song->description)) !!}</p>
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</div>

@if($relatedSongs->count() > 0)
<h3 class="section-title mb-4">More from {{ $song->composer->name }}</h3>
<div class="row">
    @foreach($relatedSongs as $relatedSong)
    <div class="col-md-3 mb-4">
        <div class="card song-card">
            <div class="image-wrapper">
                @if($relatedSong->cover_image)
                    <img src="{{ asset('storage/' . $relatedSong->cover_image) }}" alt="{{ $relatedSong->title }}">
                @else
                    <img src="{{ asset('images/default-cover.jpg') }}" alt="{{ $relatedSong->title }}">
                @endif
                <div class="play-hover" onclick="playSong(
                    '{{ $relatedSong->id }}',
                    '{{ $relatedSong->title }}',
                    '{{ $song->composer->name }}',
                    '{{ $relatedSong->cover_image ? asset('storage/' . $relatedSong->cover_image) : asset('images/default-cover.jpg') }}',
                    '{{ route('player.stream', $relatedSong) }}'
                )">
                    <i class="fas fa-play-circle"></i>
                </div>
            </div>
            <div class="card-body" onclick="window.location.href='{{ route('player.song', $relatedSong) }}'">
                <h5>{{ $relatedSong->title }}</h5>
                <p class="text-light">{{ $relatedSong->year ?? 'Unknown' }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection

@section('scripts')
<script>
    window.pagePlaylist = [
        {
            id: '{{ $song->id }}',
            title: '{{ $song->title }}',
            composer: '{{ $song->composer->name }}',
            cover: '{{ $song->cover_image ? asset('storage/' . $song->cover_image) : asset('images/default-cover.jpg') }}',
            url: '{{ route('player.stream', $song) }}'
        },
        @foreach($relatedSongs as $relatedSong)
        {
            id: '{{ $relatedSong->id }}',
            title: '{{ $relatedSong->title }}',
            composer: '{{ $song->composer->name }}',
            cover: '{{ $relatedSong->cover_image ? asset('storage/' . $relatedSong->cover_image) : asset('images/default-cover.jpg') }}',
            url: '{{ route('player.stream', $relatedSong) }}'
        },
        @endforeach
    ];
</script>
@endsection

@section('styles')
<style>
    .song-meta-item {
        display: flex;
        align-items: center;
        background: rgba(142, 68, 173, 0.2);
        padding: 8px 15px;
        border-radius: 20px;
        margin-right: 10px;
    }
    
    .song-meta-item i {
        color: var(--primary-color);
        margin-right: 8px;
        font-size: 16px;
    }
    
    .song-meta-item span {
        color: white;
        font-weight: 500;
    }
    
    .audio-waveform audio {
        border-radius: 10px;
    }
    
    /* Ensure all text is visible */
    p, h5, span, div {
        color: var(--text-color);
    }
</style>
@endsection