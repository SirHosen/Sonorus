@extends('layouts.admin')

@section('title', 'Manage Users')

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
    
    .user-avatar-small {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        text-transform: uppercase;
        font-family: 'Playfair Display', serif;
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

    .role-badge {
        font-size: 0.7rem;
        padding: 0.35em 0.8em;
        border-radius: 6px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
    
    .role-admin { background: rgba(239, 68, 68, 0.2); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.3); }
    .role-user { background: rgba(16, 185, 129, 0.2); color: #6ee7b7; border: 1px solid rgba(16, 185, 129, 0.3); }

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
        <h4 class="mb-1" style="font-family: 'Playfair Display', serif; font-weight: 700;">Community Members</h4>
        <p class="text-secondary small mb-0">Oversee user access and roles.</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="fas fa-plus"></i> Add New User
    </a>
</div>

<div class="card glass-panel border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table glass-table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">User</th>
                        <th>Email Contact</th>
                        <th>Access Role</th>
                        <th>Joined Date</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="user-avatar-small me-3">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-light">{{ $user->name }}</h6>
                                    <small class="text-secondary">ID: #{{ $user->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-light">{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="role-badge {{ $role->name == 'admin' ? 'role-admin' : 'role-user' }}">
                                    {{ ucfirst($role->name) }}
                                </span>
                            @endforeach
                        </td>
                        <td class="text-light">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.users.show', $user) }}" class="action-btn btn-view" title="View Details">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="action-btn btn-edit" title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn btn-delete" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-secondary">
                                <i class="fas fa-users fa-3x mb-3 opacity-25"></i>
                                <p>No users found.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($users->hasPages())
        <div class="d-flex justify-content-center p-4 border-top border-secondary border-opacity-10">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
