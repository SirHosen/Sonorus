@extends('layouts.admin')

@section('title', 'Song Details')

@section('styles')
<style>
    .music-player-card {
        background: linear-gradient(145deg, rgba(30, 41, 59, 0.9), rgba(15, 23, 42, 0.95));
        border-radius: 20px;
        overflow: hidden;
        position: relative;
    }
    
    .album-art-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        filter: blur(50px);
        opacity: 0.2;
        z-index: 1;
    }
    
    .player-content {
        position: relative;
        z-index: 2;
        padding: 3rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .album-art {
        width: 250px;
        height: 250px;
        border-radius: 20px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        margin-bottom: 2rem;
        object-fit: cover;
        border: 1px solid rgba(255,255,255,0.1);
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    
    .song-title-lg {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: #fff;
        text-align: center;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 10px rgba(0,0,0,0.3);
    }
    
    .composer-name-lg {
        font-size: 1.25rem;
        color: var(--primary-accent);
        margin-bottom: 2rem;
        font-weight: 500;
    }
    
    .custom-audio-player {
        width: 100%;
        max-width: 600px;
        margin-top: 1rem;
    }
    
    .custom-audio-player audio {
        width: 100%;
        height: 40px;
        border-radius: 20px;
    }
    
    .meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }
    
    .meta-item {
        background: rgba(255,255,255,0.03);
        padding: 1rem;
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.05);
    }
    
    .meta-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-secondary);
        margin-bottom: 0.25rem;
    }
    
    .meta-value {
        color: #fff;
        font-weight: 500;
    }
</style>
@endsection

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <a href="{{ route('admin.songs.index') }}" class="btn btn-outline-secondary btn-sm mb-2">
            <i class="fas fa-arrow-left me-2"></i> Back to Songs
        </a>
    </div>
    <div class="d-flex gap-2">
         <a href="{{ route('admin.songs.edit', $song) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i> Edit Metadata
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card music-player-card glass-panel border-0">
            <div class="album-art-bg" style="background-image: url('{{ $song->cover_image ? asset('storage/' . $song->cover_image) : asset('images/default-cover.jpg') }}');"></div>
            
            <div class="player-content">
                @if($song->cover_image)
                    <img src="{{ asset('storage/' . $song->cover_image) }}" alt="{{ $song->title }}" class="album-art">
                @else
                    <img src="{{ asset('images/default-cover.jpg') }}" alt="{{ $song->title }}" class="album-art">
                @endif
                
                <h1 class="song-title-lg">{{ $song->title }}</h1>
                <a href="{{ route('admin.composers.show', $song->composer) }}" class="text-decoration-none">
                    <div class="composer-name-lg">{{ $song->composer->name }}</div>
                </a>
                
                <div class="custom-audio-player">
                    <audio controls>
                        <source src="{{ route('audio.stream', $song) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            </div>
        </div>
        
        <div class="card glass-panel border-0 mt-4">
            <div class="card-body p-4">
                <h5 class="text-light mb-4 pb-2 border-bottom border-secondary border-opacity-25">About this Composition</h5>
                
                <div class="text-secondary mb-4" style="line-height: 1.8;">
                    @if($song->description)
                        {!! nl2br(e($song->description)) !!}
                    @else
                        <p class="fst-italic text-muted">No description provided.</p>
                    @endif
                </div>
                
                <div class="meta-grid">
                    <div class="meta-item">
                        <div class="meta-label">Composition Year</div>
                        <div class="meta-value">{{ $song->year ?? 'Unknown' }}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Duration</div>
                        <div class="meta-value">{{ $song->duration ?? 'Calculating...' }}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">File Format</div>
                        <div class="meta-value">{{ strtoupper(pathinfo($song->audio_file, PATHINFO_EXTENSION)) }}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Added On</div>
                        <div class="meta-value">{{ $song->created_at->format('M d, Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
