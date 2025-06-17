@extends('layouts.admin')

@section('title', 'Manage Songs')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>All Songs</h5>
        <a href="{{ route('admin.songs.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Song
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Composer</th>
                        <th>Year</th>
                        <th>Duration</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($songs as $song)
                    <tr>
                        <td>{{ $song->id }}</td>
                        <td>
                            @if($song->cover_image)
                                <img src="{{ asset('storage/' . $song->cover_image) }}" alt="{{ $song->title }}" width="50" height="50" class="rounded">
                            @else
                                <img src="{{ asset('images/default-cover.jpg') }}" alt="{{ $song->title }}" width="50" height="50" class="rounded">
                            @endif
                        </td>
                        <td>{{ $song->title }}</td>
                        <td>
                            <a href="{{ route('admin.composers.show', $song->composer) }}">
                                {{ $song->composer->name }}
                            </a>
                        </td>
                        <td>{{ $song->year ?? 'Unknown' }}</td>
                        <td>{{ $song->duration ?? 'Unknown' }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.songs.show', $song) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.songs.edit', $song) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.songs.destroy', $song) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this song?');" class="d-inline">
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
                        <td colspan="7" class="text-center">No songs found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $songs->links() }}
        </div>
    </div>
</div>
@endsection
