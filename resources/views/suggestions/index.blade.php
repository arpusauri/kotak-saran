@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>📋 All Suggestions</h2>
            <p class="text-muted">View suggestions from our community</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('suggestions.create') }}" class="btn btn-primary">
                ➕ Submit New Suggestion
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @forelse($suggestions as $suggestion)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <h5 class="card-title">{{ $suggestion->message }}</h5>
                        <p class="text-muted small mb-2">
                            <strong>{{ $suggestion->name }}</strong> • 
                            <span class="badge bg-secondary">{{ ucfirst($suggestion->category) }}</span>
                            <span class="badge bg-{{ $suggestion->status === 'resolved' ? 'success' : ($suggestion->status === 'reviewed' ? 'info' : 'warning') }}">
                                {{ ucfirst($suggestion->status) }}
                            </span>
                        </p>
                        @if($suggestion->response)
                            <p class="card-text text-truncate">{{ $suggestion->response }}</p>
                        @else
                            <p class="card-text text-muted"><em>Waiting for response...</em></p>
                        @endif
                    </div>
                    <div class="col-md-3 text-end">
                        @if($suggestion->rating)
                            <div class="mb-2">
                                <strong>⭐ {{ $suggestion->rating->rating }}/5</strong>
                            </div>
                        @endif
                        <p class="small text-muted">{{ $suggestion->created_at->format('d M Y') }}</p>
                        <a href="{{ route('suggestions.track', $suggestion->id) }}" class="btn btn-sm btn-outline-primary">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            <p class="mb-0">No suggestions available yet. Be the first to submit one!</p>
        </div>
    @endforelse

    <div class="d-flex justify-content-center mt-4">
        {{ $suggestions->links() }}
    </div>
</div>
@endsection