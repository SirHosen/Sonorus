@extends('layouts.admin')

@section('title', 'Add New Composer')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1" style="color: var(--text-primary); font-family: 'Playfair Display', serif;">New Composer</h4>
                <p class="text-secondary small mb-0">Record the details of a musical master.</p>
            </div>
            <a href="{{ route('admin.composers.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-2"></i> Back to List
            </a>
        </div>

        <div class="card glass-panel border-0">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.composers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <h6 class="text-uppercase fw-bold text-secondary small mb-4" style="letter-spacing: 1px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.5rem;">
                        <i class="fas fa-info-circle me-2"></i> Basic Information
                    </h6>
                    
                    <div class="mb-4">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required placeholder="e.g. Ludwig van Beethoven">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="country" class="form-label">Country of Origin</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-globe"></i></span>
                            <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" value="{{ old('country') }}" placeholder="e.g. Germany">
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
                                <input type="text" class="form-control @error('birth_year') is-invalid @enderror" id="birth_year" name="birth_year" value="{{ old('birth_year') }}" placeholder="e.g. 1770">
                                @error('birth_year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="death_year" class="form-label">Death Year</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-minus"></i></span>
                                <input type="text" class="form-control @error('death_year') is-invalid @enderror" id="death_year" name="death_year" value="{{ old('death_year') }}" placeholder="e.g. 1827">
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
                        <textarea class="form-control @error('biography') is-invalid @enderror" id="biography" name="biography" rows="6" placeholder="Write a short biography...">{{ old('biography') }}</textarea>
                        @error('biography')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="photo" class="form-label">Portrait Photo</label>
                        <div class="file-upload-wrapper">
                            <input type="file" id="photo" name="photo" class="file-upload-input @error('photo') is-invalid @enderror" accept="image/*">
                            <div class="file-upload-content">
                                <i class="fas fa-image file-upload-icon"></i>
                                <div class="file-upload-text">Click to upload Photo or drag file here</div>
                                <div class="file-upload-hint">JPEG, PNG (Max 2MB)</div>
                            </div>
                        </div>
                        @error('photo')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-end mt-5 pt-3 border-top border-secondary border-opacity-10">
                        <button type="submit" class="btn btn-primary px-4 py-2 d-flex align-items-center">
                            <i class="fas fa-save me-2"></i> Save Composer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
