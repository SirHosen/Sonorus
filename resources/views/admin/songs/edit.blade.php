@extends('layouts.admin')

@section('title', 'Edit Song')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1" style="color: var(--text-primary); font-family: 'Playfair Display', serif;">Edit Composition</h4>
                <p class="text-secondary small mb-0">Update details for {{ $song->title }}</p>
            </div>
            <a href="{{ route('admin.songs.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-2"></i> Back to Songs
            </a>
        </div>

        <div class="card glass-panel border-0">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.songs.update', $song) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <h6 class="text-uppercase fw-bold text-secondary small mb-4" style="letter-spacing: 1px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.5rem;">
                        <i class="fas fa-music me-2"></i> Track Details
                    </h6>
                    
                    <div class="mb-4">
                        <label for="title" class="form-label">Song Title <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $song->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="composer_id" class="form-label">Composer <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                <select class="form-select @error('composer_id') is-invalid @enderror" id="composer_id" name="composer_id" required>
                                    <option value="">Select a composer</option>
                                    @foreach($composers as $composer)
                                        <option value="{{ $composer->id }}" {{ (old('composer_id', $song->composer_id) == $composer->id) ? 'selected' : '' }}>
                                            {{ $composer->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('composer_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="year" class="form-label">Composition Year</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="text" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year', $song->year) }}">
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $song->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <h6 class="text-uppercase fw-bold text-secondary small mb-4 mt-5" style="letter-spacing: 1px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.5rem;">
                        <i class="fas fa-cloud-upload-alt me-2"></i> Media Files
                    </h6>
                    
                    <div class="mb-4">
                        <label for="audio_file" class="form-label">Audio File</label>
                        @if($song->audio_file)
                            <div class="mb-3 p-3 rounded" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05);">
                                <div class="small text-secondary mb-2"><i class="fas fa-check-circle text-success me-1"></i> Current Audio File</div>
                                <audio controls class="w-100" style="height: 32px;">
                                    <source src="{{ route('audio.stream', $song) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        @endif
                        <div class="file-upload-wrapper">
                            <input type="file" id="audio_file" name="audio_file" class="file-upload-input @error('audio_file') is-invalid @enderror" accept="audio/*">
                            <div class="file-upload-content">
                                <i class="fas fa-file-audio file-upload-icon"></i>
                                <div class="file-upload-text">Click to replace Audio or drag new file here</div>
                                <div class="file-upload-hint">MP3, WAV, OGG (Max 20MB)</div>
                            </div>
                        </div>
                        @error('audio_file')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="cover_image" class="form-label">Cover Artwork</label>
                        @if($song->cover_image)
                            <div class="mb-3 d-flex align-items-center gap-3 p-2 rounded" style="background: rgba(255,255,255,0.02);">
                                <img src="{{ asset('storage/' . $song->cover_image) }}" alt="{{ $song->title }}" width="60" height="60" class="rounded object-fit-cover shadow-sm">
                                <div class="small text-secondary">Current cover image</div>
                            </div>
                        @endif
                        <div class="file-upload-wrapper">
                            <input type="file" id="cover_image" name="cover_image" class="file-upload-input @error('cover_image') is-invalid @enderror" accept="image/*">
                            <div class="file-upload-content">
                                <i class="fas fa-image file-upload-icon"></i>
                                <div class="file-upload-text">Click to replace Cover Art or drag new file here</div>
                                <div class="file-upload-hint">JPEG, PNG (Max 2MB)</div>
                            </div>
                        </div>
                        @error('cover_image')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end mt-5 pt-3 border-top border-secondary border-opacity-10">
                        <button type="submit" class="btn btn-primary px-4 py-2 d-flex align-items-center">
                            <i class="fas fa-save me-2"></i> Update Song
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
