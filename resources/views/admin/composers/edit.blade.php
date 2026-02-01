@extends('layouts.admin')

@section('title', 'Edit Composer')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1" style="color: var(--text-primary); font-family: 'Playfair Display', serif;">Edit Composer</h4>
                <p class="text-secondary small mb-0">Update details for {{ $composer->name }}</p>
            </div>
            <a href="{{ route('admin.composers.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-2"></i> Back to List
            </a>
        </div>

        <div class="card glass-panel border-0">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.composers.update', $composer) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <h6 class="text-uppercase fw-bold text-secondary small mb-4" style="letter-spacing: 1px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.5rem;">
                        <i class="fas fa-info-circle me-2"></i> Basic Information
                    </h6>
                    
                    <div class="mb-4">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $composer->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="country" class="form-label">Country of Origin</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-globe"></i></span>
                            <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" value="{{ old('country', $composer->country) }}">
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="birth_year" class="form-label">Birth Year</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-plus"></i></span>
                                <input type="text" class="form-control @error('birth_year') is-invalid @enderror" id="birth_year" name="birth_year" value="{{ old('birth_year', $composer->birth_year) }}">
                                @error('birth_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="death_year" class="form-label">Death Year</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-minus"></i></span>
                                <input type="text" class="form-control @error('death_year') is-invalid @enderror" id="death_year" name="death_year" value="{{ old('death_year', $composer->death_year) }}">
                                @error('death_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <h6 class="text-uppercase fw-bold text-secondary small mb-4 mt-5" style="letter-spacing: 1px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.5rem;">
                        <i class="fas fa-book-open me-2"></i> Details & Media
                    </h6>
                    
                    <div class="mb-4">
                        <label for="biography" class="form-label">Biography</label>
                        <textarea class="form-control @error('biography') is-invalid @enderror" id="biography" name="biography" rows="6">{{ old('biography', $composer->biography) }}</textarea>
                        @error('biography')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="photo" class="form-label">Portrait Photo</label>
                        @if($composer->photo)
                            <div class="mb-3 d-flex align-items-center gap-3 p-2 rounded" style="background: rgba(255,255,255,0.02);">
                                <img src="{{ asset('storage/' . $composer->photo) }}" alt="{{ $composer->name }}" width="60" height="60" class="rounded-circle object-fit-cover border border-secondary shadow-sm">
                                <div class="small text-secondary">Current photo</div>
                            </div>
                        @endif
                        <div class="file-upload-wrapper">
                            <input type="file" id="photo" name="photo" class="file-upload-input @error('photo') is-invalid @enderror" accept="image/*">
                            <div class="file-upload-content">
                                <i class="fas fa-image file-upload-icon"></i>
                                <div class="file-upload-text">Click to replace Photo or drag new file here</div>
                                <div class="file-upload-hint">JPEG, PNG (Max 2MB)</div>
                            </div>
                        </div>
                        @error('photo')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end mt-5 pt-3 border-top border-secondary border-opacity-10">
                        <button type="submit" class="btn btn-primary px-4 py-2 d-flex align-items-center">
                            <i class="fas fa-save me-2"></i> Update Composer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
