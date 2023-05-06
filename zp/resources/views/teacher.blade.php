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
        <br>
        <h2>Uploaded Files:</h2>
        <ul>
            @foreach($latexFiles as $file)
                <li>
                    {{ $file->file_name }}
                    <form action="{{ route('teacher.delete', $file->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    <form action="{{ route('teacher.togglePublish', $file->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm {{ $file->is_published ? 'btn-warning' : 'btn-success' }}">
                            {{ $file->is_published ? 'Unpublish' : 'Publish' }}
                        </button>
                    </form>
                </li>
            @endforeach
        </ul>
        <br>
        <h2>Uploaded Images:</h2>
        <ul>
            @foreach($images as $image)
                <li>
                    {{ $image->file_name }}
                    <form action="{{ route('teacher.deleteImage', $image->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <br>
        <br>
    </div>
@endsection
