@extends('layouts.admin')

@section('title', 'Add New Song')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.songs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="composer_id" class="form-label">Composer <span class="text-danger">*</span></label>
                    <select class="form-select @error('composer_id') is-invalid @enderror" id="composer_id" name="composer_id" required>
                        <option value="">Select a composer</option>
                        @foreach($composers as $composer)
                            <option value="{{ $composer->id }}" {{ old('composer_id') == $composer->id ? 'selected' : '' }}>
                                {{ $composer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('composer_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="year" class="form-label">Year</label>
                    <input type="text" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year') }}">
                    @error('year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="audio_file" class="form-label">Audio File <span class="text-danger">*</span></label>
                <input type="file" class="form-control @error('audio_file') is-invalid @enderror" id="audio_file" name="audio_file" required>
                <small class="text-muted">Upload an audio file (MP3, WAV, OGG, max 20MB)</small>
                @error('audio_file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="cover_image" class="form-label">Cover Image</label>
                <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image">
                <small class="text-muted">Upload a cover image (JPEG, PNG, JPG, GIF, max 2MB)</small>
                @error('cover_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.songs.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Song</button>
            </div>
        </form>
    </div>
</div>
@endsection
