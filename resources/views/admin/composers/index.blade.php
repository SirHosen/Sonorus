@extends('layouts.admin')

@section('title', 'Manage Composers')

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
    
    .composer-avatar-wrapper {
        position: relative;
        width: 50px;
        height: 50px;
    }
    
    .composer-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid rgba(252, 211, 77, 0.3);
        transition: transform 0.3s ease;
    }
    
    .glass-table tr:hover .composer-avatar {
        transform: scale(1.1);
        border-color: var(--primary-accent);
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

    .header-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .badge-modern {
        font-size: 0.7rem;
        padding: 0.35em 0.8em;
        border-radius: 6px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    
    .badge-primary { background: rgba(59, 130, 246, 0.2); color: #93c5fd; }
</style>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h4 class="mb-1" style="font-family: 'Playfair Display', serif; font-weight: 700;">Composers Collection</h4>
        <p class="text-secondary small mb-0">Manage the maestros of your library.</p>
    </div>
    <a href="{{ route('admin.composers.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="fas fa-plus"></i> Add Composer
    </a>
</div>

<div class="card glass-panel border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table glass-table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Composer</th>
                        <th>Country</th>
                        <th>Era / Years</th>
                        <th>Works</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($composers as $composer)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="composer-avatar-wrapper me-3">
                                    @if($composer->photo)
                                        <img src="{{ asset('storage/' . $composer->photo) }}" alt="{{ $composer->name }}" class="composer-avatar">
                                    @else
                                        <img src="{{ asset('images/default-composer.jpg') }}" alt="{{ $composer->name }}" class="composer-avatar">
                                    @endif
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-light">{{ $composer->name }}</h6>
                                    <small class="text-secondary">ID: #{{ $composer->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($composer->country)
                                <span class="badge bg-secondary text-light fw-normal">{{ $composer->country }}</span>
                            @else
                                <span class="text-muted small">Unknown</span>
                            @endif
                        </td>
                        <td>
                            <div class="small text-light">{{ $composer->birth_year ?? '?' }} &mdash; {{ $composer->death_year ?? 'Present' }}</div>
                        </td>
                        <td>
                            <span class="badge badge-modern badge-primary">{{ $composer->songs->count() }} Songs</span>
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.composers.show', $composer) }}" class="action-btn btn-view" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.composers.edit', $composer) }}" class="action-btn btn-edit" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('admin.composers.destroy', $composer) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this composer?');" class="d-inline">
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
                                <i class="fas fa-feather-alt fa-3x mb-3 opacity-25"></i>
                                <p>No composers found in the library.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($composers->hasPages())
        <div class="d-flex justify-content-center p-4 border-top border-secondary border-opacity-10">
            {{ $composers->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
