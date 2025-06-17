@extends('layouts.admin')

@section('title', 'Composer Details')

@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Composer Details</h5>
        <div>
            <a href="{{ route('admin.composers.edit', $composer) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.composers.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 text-center">
                @if($composer->photo)
                    <img src="{{ asset('storage/' . $composer->photo) }}" alt="{{ $composer->name }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                @else
                    <img src="{{ asset('images/default-composer.jpg') }}" alt="{{ $composer->name }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                @endif
            </div>
            <div class="col-md-8">
                <h2>{{ $composer->name }}</h2>
                <p><strong>Country:</strong> {{ $composer->country ?? 'Unknown' }}</p>
                <p><strong>Years:</strong> {{ $composer->birth_year ?? '?' }} - {{ $composer->death_year ?? 'Present' }}</p>
                
                <h5 class="mt-4">Biography</h5>
                <p>{!! nl2br(e($composer->biography)) !!}</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5>Compositions by {{ $composer->name }}</h5>
    </div>
    <div class="card-body">
        @if($composer->songs->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Year</th>
                            <th>Duration</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($composer->songs as $song)
                        <tr>
                            <td>{{ $song->title }}</td>
                            <td>{{ $song->year ?? 'Unknown' }}</td>
                            <td>{{ $song->duration ?? 'Unknown' }}</td>
                            <td>
                                <a href="{{ route('admin.songs.show', $song) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center">No compositions found for this composer.</p>
            <div class="text-center">
                <a href="{{ route('admin.songs.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add a Composition
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
