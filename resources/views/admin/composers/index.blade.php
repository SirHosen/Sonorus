@extends('layouts.admin')

@section('title', 'Manage Composers')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>All Composers</h5>
        <a href="{{ route('admin.composers.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Composer
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Years</th>
                        <th>Songs</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($composers as $composer)
                    <tr>
                        <td>{{ $composer->id }}</td>
                        <td>
                            @if($composer->photo)
                                <img src="{{ asset('storage/' . $composer->photo) }}" alt="{{ $composer->name }}" width="50" height="50" class="rounded-circle">
                            @else
                                <img src="{{ asset('images/default-composer.jpg') }}" alt="{{ $composer->name }}" width="50" height="50" class="rounded-circle">
                            @endif
                        </td>
                        <td>{{ $composer->name }}</td>
                        <td>{{ $composer->country ?? 'Unknown' }}</td>
                        <td>{{ $composer->birth_year ?? '?' }} - {{ $composer->death_year ?? 'Present' }}</td>
                        <td>{{ $composer->songs->count() }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.composers.show', $composer) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.composers.edit', $composer) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.composers.destroy', $composer) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this composer?');" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No composers found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $composers->links() }}
        </div>
    </div>
</div>
@endsection
