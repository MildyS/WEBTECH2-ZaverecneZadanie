<!-- resources/views/student.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 10px;">
        <h3>Student Dashboard</h3>

        <h3 style="margin-bottom: 10px">Published Files:</h3>

        <form method="POST" action="{{ route('student.startExam') }}">
            <br>
            @csrf

            @foreach($publishedFiles as $file)
                <div>
                    <input type="checkbox" id="file-{{ $file->id }}" name="selected_files[]" value="{{ $file->id }}">
                    <label for="file-{{ $file->id }}">{{ $file->file_name }}</label>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary" style="margin-top: 20px">Start exam</button>
        </form>

    </div>
@endsection


<style>
    h3{
        color: #e5e7eb;
        font-weight: bolder;
    }

    .container{
        color: #e5e7eb;
    }

    .btn-link :hover{
        color: #da3c8b;
        text-shadow: 0 0 1px #da3c8b;
    }
</style>
