@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-header">
                <h5>Total Users</h5>
            </div>
            <div class="card-body">
                <h1 class="display-4">{{ $totalUsers }}</h1>
                <p class="card-text">Registered users in the system</p>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Manage Users</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-header">
                <h5>Total Composers</h5>
            </div>
            <div class="card-body">
                <h1 class="display-4">{{ $totalComposers }}</h1>
                <p class="card-text">Classical music composers</p>
                <a href="{{ route('admin.composers.index') }}" class="btn btn-primary">Manage Composers</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-header">
                <h5>Total Songs</h5>
            </div>
            <div class="card-body">
                <h1 class="display-4">{{ $totalSongs }}</h1>
                <p class="card-text">Classical music pieces</p>
                <a href="{{ route('admin.songs.index') }}" class="btn btn-primary">Manage Songs</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Welcome to Sonorus Admin Dashboard</h5>
            </div>
            <div class="card-body">
                <p>From here, you can manage all aspects of your classical music streaming platform:</p>
                <ul>
                    <li>Add and manage composers</li>
                    <li>Upload and organize classical music pieces</li>
                    <li>Manage user accounts and permissions</li>
                </ul>
                <p>Use the sidebar to navigate to different sections of the admin panel.</p>
            </div>
        </div>
    </div>
</div>
@endsection
