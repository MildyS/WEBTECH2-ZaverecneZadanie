<!-- resources/views/student.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Student Dashboard</h1>

    <h2>Published Files:</h2>
    <ul>
        @foreach($publishedFiles as $file)
            <li>{{ $file->file_name }}</li>
        @endforeach
    </ul>

</div>
@endsection
