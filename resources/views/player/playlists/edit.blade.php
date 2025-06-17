<!-- resources/views/player/playlists/edit.blade.php -->
@extends('layouts.player')

@section('title', 'Edit Playlist')

@section('content')
<div class="playlist-edit-container">
    <div class="playlist-form-card">
        <div class="playlist-form-header">
            <h2><i class="fas fa-edit me-2"></i> Edit Playlist</h2>
            <p>Update your playlist "{{ $playlist->name }}"</p>
        </div>
        
        <form action="{{ route('player.playlists.update', $playlist) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">
                    <i class="fas fa-music me-2"></i> Playlist Name <span class="required">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name', $playlist->name) }}" required class="form-control-custom @error('name') is-invalid @enderror">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="description">
                    <i class="fas fa-align-left me-2"></i> Description
                </label>
                <textarea id="description" name="description" rows="4" class="form-control-custom @error('description') is-invalid @enderror" placeholder="Add a description to help you remember what this playlist is about.">{{ old('description', $playlist->description) }}</textarea>
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
                        @if($playlist->cover_image)
                            <img src="{{ asset('storage/' . $playlist->cover_image) }}" alt="{{ $playlist->name }}">
                        @else
                            <i class="fas fa-music"></i>
                        @endif
                    </div>
                    <div class="cover-upload-info">
                        <div class="custom-file-upload">
                            <input type="file" id="cover_image" name="cover_image" class="file-input @error('cover_image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/gif">
                            <label for="cover_image" class="file-label">
                                <i class="fas fa-cloud-upload-alt me-2"></i> Change Image
                            </label>
                        </div>
                        <p class="upload-help">Upload a new cover image to replace the existing one (JPEG, PNG, JPG, GIF, max 2MB)</p>
                        <p class="selected-file" id="selectedFileName">
                            @if($playlist->cover_image)
                                Current: {{ basename($playlist->cover_image) }}
                            @else
                                No image selected
                            @endif
                        </p>
                        @error('cover_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="form-actions">
                <a href="{{ route('player.playlists.show', $playlist) }}" class="btn-cancel">
                    <i class="fas fa-times me-2"></i> Cancel
                </a>
                <button type="submit" class="btn-update">
                    <i class="fas fa-save me-2"></i> Update Playlist
                </button>
            </div>
        </form>
    </div>
    
    <div class="playlist-danger-zone">
        <div class="danger-zone-header">
            <h3><i class="fas fa-exclamation-triangle me-2"></i> Danger Zone</h3>
        </div>
        <div class="danger-zone-content">
            <p>Once you delete a playlist, there is no going back. Please be certain.</p>
            <form action="{{ route('player.playlists.destroy', $playlist) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this playlist? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">
                    <i class="fas fa-trash-alt me-2"></i> Delete this playlist
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .playlist-edit-container {
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
        margin-bottom: 30px;
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
    
    .btn-update {
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
    
    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(155, 89, 182, 0.4);
    }
    
    .invalid-feedback {
        color: #e74c3c;
        font-size: 14px;
        margin-top: 5px;
        display: block;
    }
    
    /* Danger Zone */
    .playlist-danger-zone {
        background: rgba(30, 41, 59, 0.7);
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(231, 76, 60, 0.3);
    }
    
    .danger-zone-header {
        margin-bottom: 20px;
        border-bottom: 1px solid rgba(231, 76, 60, 0.3);
        padding-bottom: 15px;
    }
    
    .danger-zone-header h3 {
        color: #e74c3c;
        font-size: 20px;
        margin: 0;
    }
    
    .danger-zone-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .danger-zone-content p {
        margin: 0;
        color: var(--text-muted);
        max-width: 60%;
    }
    
    .btn-delete {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(231, 76, 60, 0.2);
        color: #e74c3c;
        border: 1px solid rgba(231, 76, 60, 0.4);
        border-radius: 30px;
        padding: 12px 25px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .btn-delete:hover {
        background: rgba(231, 76, 60, 0.3);
        color: #fff;
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
        
        .danger-zone-content {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .danger-zone-content p {
            max-width: 100%;
            margin-bottom: 15px;
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
                selectedFileName.textContent = 'Selected: ' + file.name;
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    coverPreview.innerHTML = `<img src="${e.target.result}" alt="Cover Preview">`;
                }
                reader.readAsDataURL(file);
            } else {
                @if($playlist->cover_image)
                    coverPreview.innerHTML = `<img src="{{ asset('storage/' . $playlist->cover_image) }}" alt="{{ $playlist->name }}">`;
                    selectedFileName.textContent = 'Current: {{ basename($playlist->cover_image) }}';
                @else
                    coverPreview.innerHTML = `<i class="fas fa-music"></i>`;
                    selectedFileName.textContent = 'No image selected';
                @endif
            }
        });
    });
</script>
@endsection
