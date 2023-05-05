<!-- resources/views/teacher.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome, Teacher!</h1>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <h2>Upload LaTeX Files</h2>
        <form action="{{ route('teacher.upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Choose LaTeX File</label>
                <input type="file" name="file" id="file" class="form-control" required>
                @error('file')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Files</button>
        </form>

        <h2>Uploaded Files:</h2>
        <ul>
            @foreach($latexFiles as $file)
                <li>{{ $file->file_name }}</li>
            @endforeach
        </ul>
    </div>
@endsection
