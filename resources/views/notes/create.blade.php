@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Upload a Note</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Title Field -->
                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <!-- Description Field -->
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                            </div>
                            <!-- Subject Dropdown -->
                            <div class="form-group mb-3">
                                <label for="subject">Subject</label>
                                <select class="form-control" id="subject" name="subject_id" required>
                                    <option value="" disabled selected>Select a subject</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Language Dropdown -->
                            <div class="form-group mb-3">
                                <label for="language">Language</label>
                                <select class="form-control" id="language" name="language" required>
                                    <option value="" disabled selected>Select a language</option>
                                    @foreach($languages as $language)
                                        <option value="{{ $language }}">{{ $language }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- File Field -->
                            <div class="form-group mb-3">
                                <label for="file">File</label>
                                <input type="file" class="form-control" id="file" name="file" required>
                            </div>
                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
