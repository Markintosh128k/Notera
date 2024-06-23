@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Notes for {{ $subject->name }}</h1>
        
        @if($notes->isEmpty())
            <div class="col-12">
                <div class="alert alert-warning text-center">No notes found</div>
            </div>
        @else
            <div class="row">
                @foreach ($notes as $note)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ htmlspecialchars($note->title) }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Author: {{ htmlspecialchars($note->user->name) }}</h6> <!-- Assuming you have a relationship set up for user -->
                                <p class="card-text"><strong>Date:</strong> {{ htmlspecialchars($note->created_at) }}</p>
                                <p class="card-text flex-grow-1">
                                    {{ Str::limit(htmlspecialchars($note->description), 100) }}
                                    @if (strlen($note->description) > 100)
                                        ... <a href="#" onclick="showFullDescription('{{ htmlspecialchars($note->title) }}', '{{ htmlspecialchars(addslashes($note->description)) }}'); return false;">Read more</a>
                                    @endif
                                </p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
				<a href="{{ asset('storage/' . $note->path) }}" class="btn btn-primary download-btn w-100" download><i class="fas fa-file-pdf"></i> Download</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
     function showFullDescription(title, description) {
         // Implement your JavaScript function to show full description in a modal or popup
         alert(title + ": " + description); // Example implementation
     }
    </script>
@endsection
