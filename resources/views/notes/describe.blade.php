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
                        <p id="description">Description: <br> {{ $note->description }}</p>

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
                                        - {{ $review->user->name }} |
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $review->id }}">
                                            Read more...
                                        </button>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="reviewModal{{ $review->id }}" tabindex="-1" aria-labelledby="reviewModalLabel{{ $review->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="reviewModalLabel{{ $review->id }}">{{ $review->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ $review->description }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-warning text-center">No reviews found</div>
                            @endforelse
                        </div>

                        @if(Auth::check())
                            <hr>
                            @php
                                $userReview = $note->reviews->where('user_id', auth()->id())->first();
                            @endphp
                            @if($userReview)
                                <h5>Edit your Review for "{{ $note->title }}"</h5>
                                <form id="review-form" action="{{ route('notes.reviews.update', ['note' => $note, 'review' => $userReview->id]) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Review Title:</label>
                                        <input type="text" id="title" name="title" class="form-control" value="{{ $userReview->title }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="rating">Rating:</label>
                                        <select name="rating" id="rating" class="form-control">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}" {{ $i == $userReview->rating ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Comment:</label>
                                        <textarea name="description" id="description" rows="4" class="form-control" required>{{ $userReview->description }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Review</button>
                                </form>
                            @else
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
                                        <label for="description">Comment:</label>
                                        <textarea name="description" id="description" rows="4" class="form-control" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- Optional: Add your own JavaScript logic here -->
@endsection
