@extends('layouts.admin')

@section('title', 'Composer Details')

@section('styles')
<style>
    .composer-header {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 2rem;
        background: var(--bg-card);
        border: var(--glass-border);
    }
    
    .composer-cover {
        height: 200px;
        background: linear-gradient(to right, rgba(0,0,0,0.8), rgba(0,0,0,0.4)), url('{{ asset('images/classical-bg.jpg') }}');
        background-size: cover;
        background-position: center;
    }
    
    .composer-profile-wrapper {
        padding: 0 3rem;
        margin-top: -80px;
        position: relative;
        z-index: 2;
        display: flex;
        align-items: flex-end;
        gap: 2rem;
        margin-bottom: 2rem;
    }
    
    .composer-profile-img {
        width: 180px;
        height: 180px;
        border-radius: 20px;
        overflow: hidden;
        border: 4px solid rgba(15, 23, 42, 0.8);
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    
    .composer-profile-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .composer-info h2 {
        font-size: 3rem;
        text-shadow: 0 2px 10px rgba(0,0,0,0.5);
        margin-bottom: 0.5rem;
        background: linear-gradient(to right, #fff, #e2e8f0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .composer-meta {
        display: flex;
        gap: 1.5rem;
        color: rgba(255,255,255,0.8);
        font-size: 1rem;
    }
    
    .composer-meta span {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .composer-meta i {
        color: var(--primary-accent);
    }

    .glass-list-item {
        background: rgba(255,255,255,0.02);
        border-bottom: 1px solid rgba(255,255,255,0.05);
        padding: 1.25rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.2s;
    }
    
    .glass-list-item:hover {
        background: rgba(255,255,255,0.05);
        transform: translateX(5px);
    }
    
    .glass-list-item:last-child {
        border-bottom: none;
    }

    @media (max-width: 768px) {
        .composer-profile-wrapper {
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 0 1.5rem;
        }
        
        .composer-meta {
            justify-content: center;
            flex-wrap: wrap;
        }
    }
</style>
@endsection

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <a href="{{ route('admin.composers.index') }}" class="btn btn-outline-secondary btn-sm mb-2">
            <i class="fas fa-arrow-left me-2"></i> Back to Composers
        </a>
    </div>
    <div class="d-flex gap-2">
         <a href="{{ route('admin.composers.edit', $composer) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i> Edit Profile
        </a>
    </div>
</div>

<div class="composer-header">
    <div class="composer-cover"></div>
    <div class="composer-profile-wrapper">
        <div class="composer-profile-img">
            @if($composer->photo)
                <img src="{{ asset('storage/' . $composer->photo) }}" alt="{{ $composer->name }}">
            @else
                <img src="{{ asset('images/default-composer.jpg') }}" alt="{{ $composer->name }}">
            @endif
        </div>
        <div class="composer-info pb-3">
            <h2>{{ $composer->name }}</h2>
            <div class="composer-meta">
                <span>
                    <i class="fas fa-globe"></i> {{ $composer->country ?? 'Unknown Origin' }}
                </span>
                <span>
                    <i class="fas fa-hourglass-half"></i> {{ $composer->birth_year ?? '?' }} &mdash; {{ $composer->death_year ?? 'Present' }}
                </span>
                <span>
                    <i class="fas fa-music"></i> {{ $composer->songs->count() }} Compositions
                </span>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card glass-panel border-0 h-100">
            <div class="card-header border-0 pb-0">
                <h5 class="mb-0">Biography</h5>
            </div>
            <div class="card-body">
                <div class="text-secondary" style="line-height: 1.8; text-align: justify;">
                    @if($composer->biography)
                        {!! nl2br(e($composer->biography)) !!}
                    @else
                        <p class="text-muted fst-italic">No biography available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-8">
        <div class="card glass-panel border-0 h-100">
            <div class="card-header border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Musical Works</h5>
                <a href="{{ route('admin.songs.create') }}?composer_id={{ $composer->id }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-plus me-1"></i> Add Song
                </a>
            </div>
            <div class="card-body p-0">
                @if($composer->songs->count() > 0)
                    <div class="list-group list-group-flush rounded-bottom">
                        @foreach($composer->songs as $song)
                        <div class="glass-list-item">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded bg-dark d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-music text-secondary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-light">{{ $song->title }}</h6>
                                    <div class="small text-secondary">{{ $song->year ?? 'Year Unknown' }}</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <span class="badge bg-dark text-secondary border border-secondary border-opacity-25">{{ $song->duration ?? '--:--' }}</span>
                                <a href="{{ route('admin.songs.show', $song) }}" class="btn btn-sm btn-icon btn-outline-info border-0">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-music fa-3x mb-3 text-secondary opacity-25"></i>
                        <p class="text-secondary">No compositions listed yet.</p>
                        <a href="{{ route('admin.songs.create') }}" class="btn btn-sm btn-primary">
                            Add First Composition
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
