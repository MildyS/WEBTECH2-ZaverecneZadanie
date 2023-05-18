@extends('layouts.app')

@section('content')

    <div class="container">
        <h3 class="results">Exam Results</h3>
        <div class="text">
            Points scored: {{ $correctPoints }}
        </div>
        <div class="text">
            Total possible points: {{ $totalPoints }}
        </div>

        <a href="{{ route('student') }}" class="btn btn-primary">Back to Home</a>
    </div>

@endsection
<style>
    .results,
    .text{
        color: #e5e7eb;
        font-weight: bolder;
    }
</style>
