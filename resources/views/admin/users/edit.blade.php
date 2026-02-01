@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1" style="color: var(--text-primary); font-family: 'Playfair Display', serif;">Edit User</h4>
                <p class="text-secondary small mb-0">Update account for {{ $user->name }}</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-2"></i> Back to Users
            </a>
        </div>

        <div class="card glass-panel border-0">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <h6 class="text-uppercase fw-bold text-secondary small mb-4" style="letter-spacing: 1px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.5rem;">
                        <i class="fas fa-id-card me-2"></i> Account Information
                    </h6>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <h6 class="text-uppercase fw-bold text-secondary small mb-4 mt-5" style="letter-spacing: 1px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.5rem;">
                        <i class="fas fa-shield-alt me-2"></i> Security & Access
                    </h6>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label for="password" class="form-label">New Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Leave blank to keep current">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Leave blank to keep current">
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <label for="role" class="form-label">User Role <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                    <option value="">Select a role assignment</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ (old('role', $user->roles->first()->name ?? '') == $role->name) ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text text-secondary mt-2 small">
                                <i class="fas fa-info-circle me-1"></i> Update the user's permissions level.
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-5 pt-3 border-top border-secondary border-opacity-10">
                        <button type="submit" class="btn btn-primary px-4 py-2 d-flex align-items-center">
                            <i class="fas fa-save me-2"></i> Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
