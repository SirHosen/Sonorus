<!-- resources/views/player/playlists/create.blade.php -->
@extends('layouts.player')

@section('title', 'Create New Playlist')

@section('content')
<div class="playlist-create-container">
    <div class="playlist-form-card">
        <div class="playlist-form-header">
            <h2><i class="fas fa-plus-circle me-2"></i> Create New Playlist</h2>
            <p>Create a personalized collection of your favorite classical compositions</p>
        </div>
        
        <form action="{{ route('player.playlists.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="name">
                    <i class="fas fa-music me-2"></i> Playlist Name <span class="required">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="My Classical Favorites" class="form-control-custom @error('name') is-invalid @enderror">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="description">
                    <i class="fas fa-align-left me-2"></i> Description
                </label>
                <textarea id="description" name="description" rows="4" class="form-control-custom @error('description') is-invalid @enderror" placeholder="Add a description to help you remember what this playlist is about.">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="cover_image" class="d-block">
                    <i class="fas fa-image me-2"></i> Cover Image
                </label>
                
                <div class="cover-upload-container">
                    <div class="cover-preview" id="coverPreview">
                        <i class="fas fa-music"></i>
                    </div>
                    <div class="cover-upload-info">
                        <div class="custom-file-upload">
                            <input type="file" id="cover_image" name="cover_image" class="file-input @error('cover_image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/gif">
                            <label for="cover_image" class="file-label">
                                <i class="fas fa-cloud-upload-alt me-2"></i> Choose Image
                            </label>
                        </div>
                        <p class="upload-help">Upload a cover image for your playlist (JPEG, PNG, JPG, GIF, max 2MB)</p>
                        <p class="selected-file" id="selectedFileName">No file chosen</p>
                        @error('cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <a href="{{ route('player.playlists.index') }}" class="btn-cancel">
                    <i class="fas fa-times me-2"></i> Cancel
                </a>
                <button type="submit" class="btn-create">
                    <i class="fas fa-check me-2"></i> Create Playlist
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('styles')
<style>
    .playlist-create-container {
        max-width: 800px;
        margin: 0 auto;
    }
    
    .playlist-form-card {
        background: rgba(30, 41, 59, 0.7);
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .playlist-form-header {
        margin-bottom: 30px;
        text-align: center;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .playlist-form-header h2 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: white;
        margin-bottom: 10px;
        font-size: 28px;
    }
    
    .playlist-form-header p {
        color: var(--text-muted);
        font-size: 16px;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: 500;
        color: white;
        font-size: 16px;
    }
    
    .form-group .required {
        color: var(--primary-color);
    }
    
    .form-control-custom {
        width: 100%;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        padding: 14px 16px;
        color: white;
        font-size: 16px;
        transition: all 0.3s;
    }
    
    .form-control-custom:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(155, 89, 182, 0.25);
        outline: none;
    }
    
    .form-control-custom::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }
    
    .cover-upload-container {
        display: flex;
        align-items: center;
        background: rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        padding: 20px;
    }
    
    .cover-preview {
        width: 120px;
        height: 120px;
        background: rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        color: var(--text-muted);
        font-size: 40px;
        overflow: hidden;
    }
    
    .cover-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
    }
    
    .cover-upload-info {
        flex: 1;
    }
    
    .custom-file-upload {
        margin-bottom: 10px;
    }
    
    .file-input {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
    }
    
    .file-label {
        display: inline-block;
        background: linear-gradient(45deg, var(--gradient-start), var(--gradient-end));
        color: white;
        padding: 10px 20px;
        border-radius: 30px;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 500;
        box-shadow: 0 4px 10px rgba(155, 89, 182, 0.3);
    }
    
    .file-label:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(155, 89, 182, 0.4);
    }
    
    .upload-help {
        color: var(--text-muted);
        font-size: 14px;
        margin-bottom: 5px;
    }
    
    .selected-file {
        color: white;
        font-size: 14px;
        margin: 0;
    }
    
    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .btn-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: none;
        border-radius: 30px;
        padding: 12px 25px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
    }
    
    .btn-cancel:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        text-decoration: none;
    }
    
    .btn-create {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(45deg, var(--gradient-start), var(--gradient-end));
        color: white;
        border: none;
        border-radius: 30px;
        padding: 12px 30px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 10px rgba(155, 89, 182, 0.3);
    }
    
    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(155, 89, 182, 0.4);
    }
    
    .invalid-feedback {
        color: #e74c3c;
        font-size: 14px;
        margin-top: 5px;
        display: block;
    }
    
    @media (max-width: 768px) {
        .cover-upload-container {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .cover-preview {
            margin-right: 0;
            margin-bottom: 20px;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const coverInput = document.getElementById('cover_image');
        const coverPreview = document.getElementById('coverPreview');
        const selectedFileName = document.getElementById('selectedFileName');
        
        coverInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                selectedFileName.textContent = file.name;
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    coverPreview.innerHTML = `<img src="${e.target.result}" alt="Cover Preview">`;
                }
                reader.readAsDataURL(file);
            } else {
                coverPreview.innerHTML = `<i class="fas fa-music"></i>`;
                selectedFileName.textContent = 'No file chosen';
            }
        });
    });
</script>
@endsection
