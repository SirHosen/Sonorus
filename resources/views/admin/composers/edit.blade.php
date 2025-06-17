@extends('layouts.admin')

@section('title', 'Edit Composer')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Edit Composer: {{ $composer->name }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.composers.update', $composer) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $composer->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" value="{{ old('country', $composer->country) }}">
                @error('country')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="birth_year" class="form-label">Birth Year</label>
                    <input type="text" class="form-control @error('birth_year') is-invalid @enderror" id="birth_year" name="birth_year" value="{{ old('birth_year', $composer->birth_year) }}">
                    @error('birth_year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="death_year" class="form-label">Death Year</label>
                    <input type="text" class="form-control @error('death_year') is-invalid @enderror" id="death_year" name="death_year" value="{{ old('death_year', $composer->death_year) }}">
                    @error('death_year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="biography" class="form-label">Biography</label>
                <textarea class="form-control @error('biography') is-invalid @enderror" id="biography" name="biography" rows="5">{{ old('biography', $composer->biography) }}</textarea>
                @error('biography')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                @if($composer->photo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $composer->photo) }}" alt="{{ $composer->name }}" width="100" class="img-thumbnail">
                    </div>
                @endif
                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo">
                <small class="text-muted">Upload a new photo to replace the existing one (JPEG, PNG, JPG, GIF, max 2MB)</small>
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.composers.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Composer</button>
            </div>
        </form>
    </div>
</div>
@endsection
