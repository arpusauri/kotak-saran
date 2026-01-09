<?php
// ============================================
// BLADE VIEWS
// ============================================

// File: resources/views/suggestions/create.blade.php
?>
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">✉️ Submit Your Suggestion</h5>
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

                    <form action="{{ route('suggestions.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" required>
                            @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone (Optional)</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-control @error('category') is-invalid @enderror" 
                                    id="category" name="category" required>
                                <option value="">-- Select Category --</option>
                                <option value="feedback" {{ old('category') === 'feedback' ? 'selected' : '' }}>Feedback</option>
                                <option value="complaint" {{ old('category') === 'complaint' ? 'selected' : '' }}>Complaint</option>
                                <option value="suggestion" {{ old('category') === 'suggestion' ? 'selected' : '' }}>Suggestion</option>
                                <option value="praise" {{ old('category') === 'praise' ? 'selected' : '' }}>Praise</option>
                                <option value="other" {{ old('category') === 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('category') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      id="message" name="message" rows="6" required minlength="10">{{ old('message') }}</textarea>
                            <small class="text-muted d-block mt-2">Minimum 10 characters required</small>
                            @error('message') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Submit Suggestion
                            </button>
                            <a href="{{ route('suggestions.index') }}" class="btn btn-secondary">
                                View Other Suggestions
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

?>