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
    </div>
@endsection
