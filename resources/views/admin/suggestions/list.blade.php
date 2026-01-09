@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>👨‍💼 Manage Suggestions</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('suggestions.create') }}" class="btn btn-primary">
                ➕ Create New Suggestion
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Message</th>
                        <th>Submitted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suggestions as $suggestion)
                        <tr>
                            <td><strong>#{{ $suggestion->id }}</strong></td>
                            <td>{{ $suggestion->name }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ ucfirst($suggestion->category) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $suggestion->status === 'resolved' ? 'success' : ($suggestion->status === 'reviewed' ? 'info' : 'warning') }}">
                                    {{ ucfirst($suggestion->status) }}
                                </span>
                            </td>
                            <td>{{ Str::limit($suggestion->message, 50) }}</td>
                            <td>
                                <small class="text-muted">{{ $suggestion->created_at->format('d M Y') }}</small>
                            </td>
                            <td>
                                <a href="{{ route('admin.suggestions.edit', $suggestion->id) }}" class="btn btn-sm btn-warning">
                                    ✏️ Edit
                                </a>
                                <a href="{{ route('admin.suggestions.activities', $suggestion->id) }}" class="btn btn-sm btn-info">
                                    📋 Log
                                </a>
                                <form action="{{ route('admin.suggestions.destroy', $suggestion->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this suggestion?')">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                No suggestions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $suggestions->links() }}
    </div>
</div>
@endsection