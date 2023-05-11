<!-- resources/views/student/exam.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Exam</h1>

        <h2>Problem:</h2>
        <p>{{ $task->task }}</p>

        <h2>Solution:</h2>
        <p>{{ $task->solution }}</p>

        @if($task->images)
            <h2>Images:</h2>
            <img src="{{ asset('/storage/latex_files' . $task->images) }}" alt="Problem image">
        @endif
    </div>
@endsection
