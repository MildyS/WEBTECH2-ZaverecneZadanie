<!-- resources/views/student.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Student Dashboard</h1>

        <h2>Published Files:</h2>

        <form method="POST" action="{{ route('student.startExam') }}">
            @csrf

            @foreach($publishedFiles as $file)
                <div>
                    <input type="checkbox" id="file-{{ $file->id }}" name="selected_files[]" value="{{ $file->id }}">
                    <label for="file-{{ $file->id }}">{{ $file->file_name }}</label>
                </div>
            @endforeach

            <button type="submit">Start exam</button>
        </form>

    </div>
@endsection
