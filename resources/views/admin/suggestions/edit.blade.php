@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">✏️ Edit Suggestion #{{ $suggestion->id }}</h5>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.suggestions.update', $suggestion->id) }}" method="POST">
                        @csrf @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $suggestion->name) }}" required>
                                @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $suggestion->email) }}" required>
                                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" 
                                       id="phone" name="phone" value="{{ old('phone', $suggestion->phone) }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-control @error('category') is-invalid @enderror" 
                                        id="category" name="category" required>
                                    <option value="feedback" {{ old('category', $suggestion->category) === 'feedback' ? 'selected' : '' }}>Feedback</option>
                                    <option value="complaint" {{ old('category', $suggestion->category) === 'complaint' ? 'selected' : '' }}>Complaint</option>
                                    <option value="suggestion" {{ old('category', $suggestion->category) === 'suggestion' ? 'selected' : '' }}>Suggestion</option>
                                    <option value="praise" {{ old('category', $suggestion->category) === 'praise' ? 'selected' : '' }}>Praise</option>
                                    <option value="other" {{ old('category', $suggestion->category) === 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('category') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">User's Message</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required>{{ old('message', $suggestion->message) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="response" class="form-label">Admin Response</label>
                            <textarea class="form-control @error('response') is-invalid @enderror" 
                                      id="response" name="response" rows="4">{{ old('response', $suggestion->response) }}</textarea>
                            <small class="text-muted">Provide a response to the user's suggestion</small>
                            @error('response') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="pending" {{ old('status', $suggestion->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="reviewed" {{ old('status', $suggestion->status) === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                <option value="resolved" {{ old('status', $suggestion->status) === 'resolved' ? 'selected' : '' }}>Resolved</option>
                            </select>
                            @error('status') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                💾 Update Suggestion
                            </button>
                            <a href="{{ route('admin.suggestions.list') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection