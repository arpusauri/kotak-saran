@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">📊 Dashboard</h5>
                </div>
                <div class="card-body">
                    <p>Welcome, {{ auth()->user()->name }}!</p>
                    
                    @if(auth()->user()->is_admin)
                        <div class="alert alert-info">
                            <p class="mb-0">
                                <strong>👨‍💼 You are an admin!</strong>
                                <a href="{{ route('admin.suggestions.list') }}" class="btn btn-sm btn-primary">
                                    Go to Admin Dashboard
                                </a>
                            </p>
                        </div>
                    @else
                        <div class="alert alert-success">
                            <p class="mb-0">
                                <strong>✉️ Submit a suggestion:</strong>
                                <a href="{{ route('suggestions.create') }}" class="btn btn-sm btn-primary">
                                    Create Suggestion
                                </a>
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection