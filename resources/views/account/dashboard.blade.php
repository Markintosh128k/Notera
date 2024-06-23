@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $user->name }}'s Dashboard</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Notes Uploaded</h5>
                        <p class="card-text">{{ $totalNotes->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Downloads</h5>
                        <p class="card-text">{{ $totalDownloads }}</p>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-4">All Notes</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Subject</th>
                    <th>Downloads</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($totalNotes as $note)
                    <tr>
                        <td>{{ $note->title }}</td>
                        <td>{{ $note->subject_id->name }}</td>
                        <td>{{ $note->download_count }}</td>
                        <td>
                            <form action="{{ route('notes.destroy', $note->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3 class="mt-4">Notes per Subject</h3>
        <div class="row">
            @foreach($notesPerSubject as $subjectId => $total)
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">{{ $subjects->find($subjectId)->name }}</h5>
                            <p class="card-text">{{ $total }} notes</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
