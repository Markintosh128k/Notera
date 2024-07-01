@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-md-12">
                <h3>Select a subject</h3>
                <div class="row">
                    @foreach ($subjects as $subject)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body text-center">
                                    <form action="{{ route('subject.notes') }}" method="post">
                                        @csrf
                                        <button type="submit" name="subject" value="{{ $subject->id }}" class="btn btn-link text-decoration-none">
                                            <span class="card-icon mb-2">
                                                {{ $emojis[$subject->name] ?? $default_emoji }}
                                            </span>
                                            <h5 class="card-title">{{ $subject->name }}</h5>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
@endsection
