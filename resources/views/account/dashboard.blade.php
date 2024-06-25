@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{ $user->name }}'s Dashboard</h1>
        @if (session('delete-ok'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('delete-ok') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h3 class="mt-4">All Notes</h3>
        @if($totalNotes->isEmpty())
            <div class="alert alert-warning text-center">No notes found</div>
        @else
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
                        <td><a href="{{ route('notes.describe', $note->id) }}">{{ $note->title }}</a></td>
                        <td>{{ $note->subject->name }}</td>
                        <td>{{ $note->download_count }}</td>
                        <td>
                            <form action="{{ route('notes.destroy', $note) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
