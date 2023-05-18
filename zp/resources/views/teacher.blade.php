<!-- resources/views/teacher.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome, Teacher!</h1>
        <table class="table data-table t1 col-md-4">
            <thead>
            <tr>
                <th data-orderable="false" style="width: 33.3%">ID</th>
                <th style="width: 33.3%">Name</th>
                <th data-orderable="false" style="width: 33.3%">Email</th>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td> {{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                </tr>
            @endforeach
            </tbody>

            <script>
                $(document).ready(function () {
                $('.t1').DataTable({
                "order": [[1, "asc"]]
                });
                });
            </script>
        </table>
        <br>
        <h2>Uploaded Files:</h2>
        <table class="table data-table col-md-4">
            <thead>
            <tr>
                <th style="width: 29%">File Name</th>
                <th style="width: 29%">Status</th>
                <th style="width: 42%">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($latexFiles as $file)
                <tr>
                    <td>{{ $file->file_name }}</td>
                    <td>
                        @if($file->publish_at)
                            @if($file->publish_at >= now())
                                Will be published at: {{ $file->publish_at }}
                            @else
                                Published at: {{ $file->publish_at }}
                            @endif
                        @else
                            Published date not set yet.
                        @endif
                    </td>
                    <td>
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
                        <form action="{{ route('teacher.setPublishDate', $file->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="datetime-local" name="publish_at" value="{{ optional($file->publish_at)->format('Y-m-d\TH:i') }}" min="{{ now()->format('Y-m-d\TH:i') }}">
                            <button type="submit" class="btn btn-sm btn-info">
                                Set Publish Date
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <h2>Uploaded Images:</h2>
        <table class="table">
            <thead>
            <tr>
                <th style="width: 85%" >Image Name</th>
                <th style="width: 15%">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($images as $image)
                <tr>
                    <td>{{ $image->file_name }}</td>
                    <td>
                        <form action="{{ route('teacher.deleteImage', $image->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <br>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js" ></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" />
<script src="resources/js/app.js" ></script>

<style>

h1{
color: #e5e7eb;
font-weight: bolder;
}

.container{
    color: #e5e7eb;
}

th, tr, td{
    color: #e5e7eb;
}
</style>
