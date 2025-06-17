<!-- resources/views/player/composers.blade.php -->
@extends('layouts.player')

@section('title', 'Composers')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <p class="text-muted">Discover the masters behind classical music's greatest works</p>
    </div>
</div>

<div class="row">
    @forelse($composers as $composer)
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
    @empty
    <div class="col-12">
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i> No composers available yet.
        </div>
    </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $composers->links() }}
</div>
@endsection
