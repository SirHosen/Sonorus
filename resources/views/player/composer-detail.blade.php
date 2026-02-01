@extends('layouts.player')

@section('title', $composer->name)

@section('content')
<div class="card mb-5">
    <div class="card-body p-4">
        <div class="row">
            <div class="col-md-3 text-center">
                @if($composer->photo)
                    <img src="{{ asset('storage/' . $composer->photo) }}" alt="{{ $composer->name }}" class="img-fluid rounded-circle mb-3" style="max-width: 200px; border: 3px solid var(--primary-color); box-shadow: 0 10px 25px rgba(142, 68, 173, 0.3);">
                @else
                    <img src="{{ asset('images/default-composer.jpg') }}" alt="{{ $composer->name }}" class="img-fluid rounded-circle mb-3" style="max-width: 200px; border: 3px solid var(--primary-color); box-shadow: 0 10px 25px rgba(142, 68, 173, 0.3);">
                @endif
                <div class="composer-meta">
                    <h6 class="mb-2">{{ $composer->birth_year ?? '?' }} - {{ $composer->death_year ?? 'Present' }}</h6>
                    <p class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>{{ $composer->country ?? 'Unknown' }}</p>
                </div>
            </div>
            <div class="col-md-9">
                <h2 class="mb-3">{{ $composer->name }}</h2>
                
                @if($composer->biography)
                    <div class="composer-bio mb-4">
                        <h5 class="mb-3"><i class="fas fa-book me-2"></i>Biography</h5>
                        <div class="p-3" style="background: rgba(255, 255, 255, 0.05); border-radius: 10px;">
                            <p>{!! nl2br(e($composer->biography)) !!}</p>
                        </div>
                    </div>
                @endif
                
                <div class="composer-stats d-flex gap-4 mt-4">
                    <div class="stat-item text-center">
                        <h3>{{ $composer->songs->count() }}</h3>
                        <p class="text-muted">Compositions</p>
                    </div>
                    @if($composer->birth_year && $composer->death_year)
                        <div class="stat-item text-center">
                            <h3>{{ $composer->death_year - $composer->birth_year }}</h3>
                            <p class="text-muted">Years Lived</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<h3 class="section-title mb-4">Compositions</h3>

<div class="compositions-wrapper">
    <div class="table-responsive">
        <table class="compositions-table">
            <thead>
                <tr>
                    <th width="60px">#</th>
                    <th width="70px"></th>
                    <th>Title</th>
                    <th width="120px">Year</th>
                    <th width="120px">Duration</th>
                    <th width="150px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($composer->songs as $index => $song)
                <tr class="composition-row">
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if($song->cover_image)
                            <img src="{{ asset('storage/' . $song->cover_image) }}" alt="{{ $song->title }}" class="composition-cover">
                        @else
                            <img src="{{ asset('images/default-cover.jpg') }}" alt="{{ $song->title }}" class="composition-cover">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('player.song', $song) }}" class="composition-title">{{ $song->title }}</a>
                    </td>
                    <td>{{ $song->year ?? 'Unknown' }}</td>
                    <td>{{ $song->duration ?? 'Unknown' }}</td>
                    <td>
                        <div class="composition-actions">
                            <button class="btn-play" onclick="playSong(
                                '{{ $song->id }}',
                                '{{ $song->title }}',
                                '{{ $composer->name }}',
                                '{{ $song->cover_image ? asset('storage/' . $song->cover_image) : asset('images/default-cover.jpg') }}',
                                '{{ route('player.stream', $song) }}'
                            )">
                                <i class="fas fa-play"></i> Play
                            </button>
                            <a href="{{ route('player.song', $song) }}" class="btn-details">
                                <i class="fas fa-info-circle"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No compositions available for this composer yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($composer->songs->count() > 0)
    <div class="text-center mt-4">
        <button class="btn btn-primary" onclick="playAllComposerSongs()">
            <i class="fas fa-play-circle me-2"></i> Play All Compositions
        </button>
    </div>
@endif
@endsection

@section('scripts')
<script>
    window.pagePlaylist = [
        @foreach($composer->songs as $song)
        {
            id: '{{ $song->id }}',
            title: '{{ $song->title }}',
            composer: '{{ $composer->name }}',
            cover: '{{ $song->cover_image ? asset('storage/' . $song->cover_image) : asset('images/default-cover.jpg') }}',
            url: '{{ route('player.stream', $song) }}'
        },
        @endforeach
    ];

    function playAllComposerSongs() {
        // Create a playlist of all composer songs
        const composerSongs = [
            @foreach($composer->songs as $song)
            {
                id: '{{ $song->id }}',
                title: '{{ $song->title }}',
                composer: '{{ $composer->name }}',
                cover: '{{ $song->cover_image ? asset('storage/' . $song->cover_image) : asset('images/default-cover.jpg') }}',
                url: '{{ route('player.stream', $song) }}'
            },
            @endforeach
        ];
        
        if (composerSongs.length > 0) {
            // Play the first song
            const firstSong = composerSongs[0];
            playSong(firstSong.id, firstSong.title, firstSong.composer, firstSong.cover, firstSong.url);
            
            // Set the playlist
            window.playlist = composerSongs;
            window.currentSongIndex = 0;
        }
    }
</script>
@endsection

@section('styles')
<style>
    .compositions-wrapper {
        background: rgba(30, 41, 59, 0.4);
        border-radius: 15px;
        padding: 5px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        margin-bottom: 30px;
    }
    
    .compositions-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .compositions-table thead th {
        background: rgba(30, 41, 59, 0.8);
        color: var(--text-color);
        padding: 15px;
        font-weight: 600;
        text-align: left;
        border-bottom: 2px solid rgba(142, 68, 173, 0.3);
        font-family: 'Playfair Display', serif;
    }
    
    .compositions-table thead th:first-child {
        border-top-left-radius: 10px;
    }
    
    .compositions-table thead th:last-child {
        border-top-right-radius: 10px;
    }
    
    .composition-row {
        transition: all 0.3s ease;
    }
    
    .composition-row:hover {
        background: rgba(142, 68, 173, 0.1);
        transform: translateX(5px);
    }
    
    .composition-row td {
        padding: 12px 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        color: var(--text-color);
        vertical-align: middle;
    }
    
    .composition-cover {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    .composition-title {
        color: var(--text-color);
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s;
        display: block;
        font-size: 16px;
    }
    
    .composition-title:hover {
        color: var(--primary-color);
    }
    
    .composition-actions {
        display: flex;
        gap: 8px;
    }
    
    .btn-play {
        background: linear-gradient(45deg, var(--gradient-start), var(--gradient-end));
        border: none;
        border-radius: 20px;
        color: white;
        padding: 6px 15px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 10px rgba(142, 68, 173, 0.3);
    }
    
    .btn-play:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(142, 68, 173, 0.4);
    }
    
    .btn-details {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-color);
        transition: all 0.3s;
    }
    
    .btn-details:hover {
        background: rgba(255, 255, 255, 0.2);
        color: var(--primary-color);
    }
    
    .stat-item {
        background: rgba(142, 68, 173, 0.1);
        padding: 15px 25px;
        border-radius: 10px;
        min-width: 120px;
    }
    
    .stat-item h3 {
        font-size: 28px;
        margin-bottom: 5px;
        color: var(--primary-color);
    }
    
    .composer-bio {
        background: rgba(30, 41, 59, 0.4);
        border-radius: 15px;
        padding: 20px;
    }
</style>
@endsection
