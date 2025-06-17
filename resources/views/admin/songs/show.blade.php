@extends('layouts.admin')

@section('title', 'Song Details')

@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Song Details</h5>
        <div>
            <a href="{{ route('admin.songs.edit', $song) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.songs.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 text-center">
                @if($song->cover_image)
                    <img src="{{ asset('storage/' . $song->cover_image) }}" alt="{{ $song->title }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                @else
                    <img src="{{ asset('images/default-cover.jpg') }}" alt="{{ $song->title }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                @endif
                
                <div class="mt-3">
                    <audio controls class="w-100">
                        <source src="{{ asset('storage/' . $song->audio_file) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            </div>
            <div class="col-md-8">
                <h2>{{ $song->title }}</h2>
                <p>
                    <strong>Composer:</strong> 
                    <a href="{{ route('admin.composers.show', $song->composer) }}">
                        {{ $song->composer->name }}
                    </a>
                </p>
                <p><strong>Year:</strong> {{ $song->year ?? 'Unknown' }}</p>
                <p><strong>Duration:</strong> {{ $song->duration ?? 'Unknown' }}</p>
                
                <h5 class="mt-4">Description</h5>
                <p>{!! nl2br(e($song->description)) !!}</p>
                
                <h5 class="mt-4">File Information</h5>
                <p><strong>File Path:</strong> {{ $song->audio_file }}</p>
                <p><strong>Added on:</strong> {{ $song->created_at->format('F d, Y') }}</p>
                <p><strong>Last updated:</strong> {{ $song->updated_at->format('F d, Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
