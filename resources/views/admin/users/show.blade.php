@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>User Details</h5>
        <div>
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="mb-3">
                    <i class="fas fa-user-circle fa-8x text-secondary"></i>
                </div>
                <h4>{{ $user->name }}</h4>
                @foreach($user->roles as $role)
                    <span class="badge bg-{{ $role->name == 'admin' ? 'danger' : 'success' }}">
                        {{ ucfirst($role->name) }}
                    </span>
                @endforeach
            </div>
            <div class="col-md-8">
                <h5>Account Information</h5>
                <table class="table">
                    <tr>
                        <th style="width: 150px;">Email:</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Registered:</th>
                        <td>{{ $user->created_at->format('F d, Y') }}</td>
                    </tr>
                    <tr>
                        <th>Last Updated:</th>
                        <td>{{ $user->updated_at->format('F d, Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@if($user->playlists->count() > 0)
<div class="card">
    <div class="card-header">
        <h5>User's Playlists</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Songs</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->playlists as $playlist)
                    <tr>
                        <td>{{ $playlist->name }}</td>
                        <td>{{ $playlist->songs->count() }}</td>
                        <td>{{ $playlist->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection
