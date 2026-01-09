@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">📊 Activity Log - Suggestion #{{ $suggestion->id }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-4 pb-3 border-bottom">
                        <p class="mb-2"><strong>Suggestion Summary:</strong></p>
                        <p class="text-muted">{{ Str::limit($suggestion->message, 100) }}</p>
                        <p class="small mb-0">
                            <span class="badge bg-secondary">{{ ucfirst($suggestion->category) }}</span>
                            <span class="badge bg-{{ $suggestion->status === 'resolved' ? 'success' : ($suggestion->status === 'reviewed' ? 'info' : 'warning') }}">
                                {{ ucfirst($suggestion->status) }}
                            </span>
                        </p>
                    </div>

                    @forelse($activities as $activity)
                        <div class="d-flex mb-4 pb-4 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="badge bg-primary rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    {{ strtoupper(substr($activity->action, 0, 1)) }}
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-1">
                                    <strong>{{ ucfirst($activity->action) }}</strong>
                                    @if($activity->user)
                                        <small class="text-muted">by {{ $activity->user->name }}</small>
                                    @endif
                                </p>
                                <p class="text-muted mb-2">{{ $activity->description }}</p>

                                @if($activity->old_value && $activity->new_value)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <small class="d-block text-danger">
                                                <strong>Before:</strong> {{ $activity->old_value }}
                                            </small>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="d-block text-success">
                                                <strong>After:</strong> {{ $activity->new_value }}
                                            </small>
                                        </div>
                                    </div>
                                @endif

                                <small class="text-muted d-block mt-2">
                                    {{ $activity->created_at->format('d M Y, H:i:s') }}
                                    @if($activity->ip_address)
                                        • IP: {{ $activity->ip_address }}
                                    @endif
                                </small>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center py-4">No activity recorded yet.</p>
                    @endforelse

                    <div class="d-flex justify-content-center mt-4">
                        {{ $activities->links() }}
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('admin.suggestions.list') }}" class="btn btn-secondary">
                    ← Back to List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection