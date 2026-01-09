<?php
// File: resources/views/suggestions/track.blade.php
?>
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">📊 Track Your Suggestion Progress</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>Status:</strong></p>
                            <span class="badge bg-{{ $suggestion->status === 'resolved' ? 'success' : ($suggestion->status === 'reviewed' ? 'info' : 'warning') }}">
                                {{ ucfirst($suggestion->status) }}
                            </span>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Submitted:</strong> {{ $suggestion->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    <hr>

                    <h6 class="mb-3">Suggestion Details</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ $suggestion->name }}</p>
                            <p><strong>Email:</strong> {{ $suggestion->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Category:</strong> <span class="badge bg-secondary">{{ ucfirst($suggestion->category) }}</span></p>
                            @if($suggestion->phone)
                                <p><strong>Phone:</strong> {{ $suggestion->phone }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <p><strong>Message:</strong></p>
                        <p class="bg-light p-3 rounded">{{ $suggestion->message }}</p>
                    </div>

                    @if($suggestion->response)
                        <div class="alert alert-info">
                            <h6 class="alert-heading">💬 Admin Response</h6>
                            <p class="mb-0">{{ $suggestion->response }}</p>
                            <small class="text-muted d-block mt-2">Responded on: {{ $suggestion->reviewed_at->format('d M Y, H:i') }}</small>
                        </div>
                    @endif

                    @if($suggestion->rating)
                        <div class="alert alert-light border">
                            <h6>⭐ Rating: {{ $suggestion->rating->rating }}/5</h6>
                            @if($suggestion->rating->comment)
                                <p class="mb-0">{{ $suggestion->rating->comment }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h6 class="mb-0">📝 Activity Timeline</h6>
                </div>
                <div class="card-body">
                    @forelse($suggestion->activities as $activity)
                        <div class="d-flex mb-3 pb-3 border-bottom">
                            <div class="flex-shrink-0">
                                <span class="badge bg-primary">{{ strtoupper(substr($activity->action, 0, 1)) }}</span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-1"><strong>{{ ucfirst($activity->action) }}</strong></p>
                                <p class="text-muted small mb-0">{{ $activity->description }}</p>
                                <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No activity recorded yet.</p>
                    @endforelse
                </div>
            </div>

            <div class="mt-3">
                <a href="{{ route('suggestions.create') }}" class="btn btn-primary">
                    ➕ Submit Another Suggestion
                </a>
                <a href="{{ route('suggestions.index') }}" class="btn btn-secondary">
                    View Top Suggestions
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

?>