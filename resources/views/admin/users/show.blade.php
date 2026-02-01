@extends('layouts.admin')

@section('title', 'User Details')

@section('styles')
<style>
    .user-profile-card {
        text-align: center;
        padding: 3rem 1rem;
    }
    
    .profile-avatar-lg {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        color: #fff;
        border-radius: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 700;
        margin: 0 auto 1.5rem;
        box-shadow: 0 10px 30px rgba(79, 70, 229, 0.3);
        font-family: 'Playfair Display', serif;
        border: 1px solid rgba(255,255,255,0.1);
    }
    
    .profile-name {
        color: #fff;
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }
    
    .profile-email {
        color: var(--text-secondary);
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .info-card {
        height: 100%;
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 16px;
        padding: 1.5rem;
    }
    
    .info-label {
        color: var(--text-secondary);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }
    
    .info-value {
        color: #fff;
        font-size: 1.1rem;
        font-weight: 500;
    }

    .role-badge.large {
        font-size: 0.9rem;
        padding: 0.5em 1.2em;
    }
    
    .role-admin { background: rgba(239, 68, 68, 0.2); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.3); }
    .role-user { background: rgba(16, 185, 129, 0.2); color: #6ee7b7; border: 1px solid rgba(16, 185, 129, 0.3); }

    .playlist-item {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 12px;
        padding: 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
        transition: transform 0.2s;
    }
    
    .playlist-item:hover {
        transform: translateY(-2px);
        background: rgba(255,255,255,0.04);
    }
</style>
@endsection

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm mb-2">
            <i class="fas fa-arrow-left me-2"></i> Back to Users
        </a>
    </div>
    <div class="d-flex gap-2">
         <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i> Edit Account
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Profile Card -->
    <div class="col-lg-4">
        <div class="card glass-panel border-0 h-100">
            <div class="card-body user-profile-card">
                <div class="profile-avatar-lg">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <h2 class="profile-name">{{ $user->name }}</h2>
                <div class="profile-email">{{ $user->email }}</div>
                
                <div class="d-flex justify-content-center gap-2 mb-4">
                    @foreach($user->roles as $role)
                        <span class="badge role-badge large {{ $role->name == 'admin' ? 'role-admin' : 'role-user' }}">
                            {{ ucfirst($role->name) }}
                        </span>
                    @endforeach
                </div>
                
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-secondary btn-sm" onclick="alert('Feature coming soon: Send Password Reset Email')">
                        <i class="fas fa-key me-2"></i> Reset Password
                    </button>
                    @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="d-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                <i class="fas fa-trash-alt me-2"></i> Delete Account
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Activity & Details -->
    <div class="col-lg-8">
        <div class="card glass-panel border-0 mb-4">
            <div class="card-header border-0 pb-0">
                <h5 class="mb-0">Account Details</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="info-card">
                            <div class="info-label"><i class="fas fa-calendar-check me-2"></i> Member Since</div>
                            <div class="info-value">{{ $user->created_at->format('F d, Y') }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-card">
                            <div class="info-label"><i class="fas fa-clock me-2"></i> Last Updated</div>
                            <div class="info-value">{{ $user->updated_at->format('F d, Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card glass-panel border-0">
            <div class="card-header border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">User's Playlists</h5>
                <span class="badge bg-secondary">{{ $user->playlists->count() }}</span>
            </div>
            <div class="card-body">
                @if($user->playlists->count() > 0)
                    @foreach($user->playlists as $playlist)
                        <div class="playlist-item">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded bg-dark d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-list-music text-secondary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-light">{{ $playlist->name }}</h6>
                                    <small class="text-muted">{{ $playlist->created_at->format('M Y') }}</small>
                                </div>
                            </div>
                            <span class="badge bg-dark border border-secondary border-opacity-25 text-secondary rounded-pill">
                                {{ $playlist->songs->count() }} songs
                            </span>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-folder-open fa-2x mb-3 text-secondary opacity-25"></i>
                        <p class="text-secondary small">No playlists created yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
