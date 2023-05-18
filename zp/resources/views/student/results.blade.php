@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Exam Results</h1>
        <div>
            Points scored: {{ $correctPoints }}
        </div>
        <div>
            Total possible points: {{ $totalPoints }}
        </div>

        <a href="{{ route('student') }}" class="btn btn-primary">Back to Home</a>
    </div>

@endsection
