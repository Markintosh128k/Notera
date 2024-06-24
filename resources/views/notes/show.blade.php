@extends('layouts.app')

@section('content')
    <div class="container">
        @if (isset($subject))
            <h1 class="text-center my-4">Notes for {{ $subject->name }}</h1>
        @else
            <h1 class="text-center my-4">Search results:</h1>
        @endif
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
                                @if (isset($search))
                                    <h6 class="card-subtitle mb-2 text-muted">Subject: {{ htmlspecialchars($note->subject->name) }}</h6>

                                @endif
                                <h6 class="card-subtitle mb-2 text-muted">Author: {{ htmlspecialchars($note->user->name) }}</h6>
                                <h6 class="card-subtitle mb-2 text-muted">Uploaded: {{ htmlspecialchars($note->created_at) }}</h6>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <a href="{{ route('notes.describe', $note->id) }}" class="btn btn-primary w-100">View</a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

