@extends('layouts.admin')

@section('title', 'Manage Songs')

@section('styles')
<style>
    .glass-table {
        color: var(--text-primary);
        vertical-align: middle;
    }
    
    .glass-table th {
        background: rgba(15, 23, 42, 0.4);
        color: var(--text-secondary);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        padding: 1rem;
    }
    
    .glass-table td {
        background: transparent;
        border-bottom: 1px solid rgba(255,255,255,0.05);
        padding: 1rem;
        color: var(--text-primary);
    }
    
    .glass-table tr:hover td {
        background: rgba(255,255,255,0.03);
    }
    
    .song-cover-wrapper {
        position: relative;
        width: 60px;
        height: 60px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.1);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    .song-cover {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .glass-table tr:hover .song-cover {
        transform: scale(1.1);
    }
    
    .play-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.2s;
    }
    
    .song-cover-wrapper:hover .play-overlay {
        opacity: 1;
    }
    
    .play-icon {
        color: #fff;
        font-size: 1.2rem;
    }
    
    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,0.05);
        color: var(--text-secondary);
        transition: all 0.2s;
        border: 1px solid transparent;
        margin-right: 5px;
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
    }
    
    .btn-view:hover { background: rgba(59, 130, 246, 0.2); color: #60a5fa; border-color: rgba(59, 130, 246, 0.3); }
    .btn-edit:hover { background: rgba(245, 158, 11, 0.2); color: #fbbf24; border-color: rgba(245, 158, 11, 0.3); }
    .btn-delete:hover { background: rgba(239, 68, 68, 0.2); color: #f87171; border-color: rgba(239, 68, 68, 0.3); }

    .composer-link {
        color: var(--primary-accent);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }
    
    .composer-link:hover {
        color: #fff;
        text-decoration: underline;
    }
    
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h4 class="mb-1" style="font-family: 'Playfair Display', serif; font-weight: 700;">Library of Songs</h4>
        <p class="text-secondary small mb-0">Browse and manage the musical collection.</p>
    </div>
    <a href="{{ route('admin.songs.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="fas fa-plus"></i> Add New Song
    </a>
</div>

<div class="card glass-panel border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table glass-table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Composition</th>
                        <th>Composer</th>
                        <th>Year</th>
                        <th>Duration</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($songs as $song)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="song-cover-wrapper me-3">
                                    @if($song->cover_image)
                                        <img src="{{ asset('storage/' . $song->cover_image) }}" alt="{{ $song->title }}" class="song-cover">
                                    @else
                                        <img src="{{ asset('images/default-cover.jpg') }}" alt="{{ $song->title }}" class="song-cover">
                                    @endif
                                    <div class="play-overlay">
                                        <i class="fas fa-play play-icon"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-light">{{ $song->title }}</h6>
                                    <small class="text-secondary">ID: #{{ $song->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.composers.show', $song->composer) }}" class="composer-link">
                                <i class="fas fa-feather-alt me-1 small"></i> {{ $song->composer->name }}
                            </a>
                        </td>
                        <td class="text-light">{{ $song->year ?? 'Unknown' }}</td>
                        <td>
                            <span class="badge bg-dark border border-secondary border-opacity-25 text-secondary rounded-pill fw-normal px-3">
                                {{ $song->duration ?? '--:--' }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.songs.show', $song) }}" class="action-btn btn-view" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.songs.edit', $song) }}" class="action-btn btn-edit" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('admin.songs.destroy', $song) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this song?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn btn-delete" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-secondary">
                                <i class="fas fa-music fa-3x mb-3 opacity-25"></i>
                                <p>No songs found in the library.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($songs->hasPages())
        <div class="d-flex justify-content-center p-4 border-top border-secondary border-opacity-10">
            {{ $songs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
