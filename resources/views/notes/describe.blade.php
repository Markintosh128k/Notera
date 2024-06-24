@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $note->title }}</h2>
                    </div>
                    <div class="card-body">
                        <div id="pdf-viewer">
                            <iframe src="{{ asset('storage/' . $note->path) }}" width="100%" height="600"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>{{ $note->description }}</p>

                        {{-- Display average rating --}}
                        <p id="average-rating">Average Rating: {{ $note->average_rating }}</p>

                        <div id="comments-section">
                            <h5>Reviews</h5>
                            @forelse ($note->reviews as $review)
                                <div class="media mb-3">
                                    <div class="media-body">
                                        @for ($i = 1; $i <= $review->rating; $i++)
                                            ⭐
                                        @endfor
                                            - {{ $review->user->name }}

                                    </div>
                                </div>
                            @empty
                                <p>No reviews yet.</p>
                            @endforelse
                        </div>

                        @if(Auth::check())
                            <hr>
                            <h5>Add a Review for "{{ $note->title }}"</h5>
                            <form id="review-form" action="{{ route('notes.reviews.store', ['note' => $note->id]) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Review Title:</label>
                                    <input type="text" id="title" name="title" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="rating">Rating:</label>
                                    <select name="rating" id="rating" class="form-control">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="content">Comment:</label>
                                    <textarea name="content" id="content" rows="4" class="form-control" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Review</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
