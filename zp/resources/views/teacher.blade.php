<!-- resources/views/teacher.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 style="margin-bottom: 10px">@lang('translation.welcomeTeacher')</h3>

        <h3 style="margin-top: 20px">@lang('translation.students')</h3>
        <table class="table data-table t1 col-md-4">
            <thead>
            <tr>
                <th data-orderable="false" style="width: 33.3%">ID</th>
                <th style="width: 33.3%">@lang('translation.name')</th>
                <th data-orderable="false" style="width: 33.3%">@lang('translation.email')</th>
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

        </table>

        <h3 style="margin-top: 20px">@lang('translation.res')</h3>
        <table class="table t2">
            <thead>
            <tr>
                <th>ID</th>
                <th data-orderable="false" >@lang('translation.name')</th>
                <th>@lang('translation.gen')</th>
                <th>@lang('translation.points')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($studentData as $data)
                <tr>
                    <td>{{ $data['id'] }}</td>
                    <td>{{ $data['name'] }}</td>
                    <td>{{ $data['filesGenerated'] }}</td>
                    <td>{{ $data['totalPoints'] }}</td>
                </tr>
            @endforeach


            </tbody>
        </table>

        <script>
            $(document).ready(function () {
                $('.t1, .t2').DataTable({
                    "order": [[1, "asc"]]
                });
            });
        </script>
        <br>

        <a href="{{ route('export') }}" class="btn btn-primary">@lang('translation.export')</a>
        <br>
        <br>
        <h3>@lang('translation.uploadedF')</h3>
        <table class="table data-table col-md-4">
            <thead>
            <tr>
                <th style="width: 29%">@lang('translation.fileName')</th>
                <th style="width: 29%">@lang('translation.status')</th>
                <th style="width: 42%">@lang('translation.actions')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($latexFiles as $file)
                <tr>
                    <td>{{ $file->file_name }}</td>
                    <td>
                        @if($file->publish_at)
                            @if($file->publish_at >= now()->addHours(2))
                                @lang('translation.willBePublished') {{ $file->publish_at }}
                            @else
                                @lang('translation.publishedAt') {{ $file->publish_at }}
                            @endif
                        @else
                            @lang('translation.publishedDateNotSet')
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('teacher.delete', $file->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">@lang('translation.delete')</button>
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
                                @lang('translation.setDate')
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <h3>@lang('translation.uploadedI')</h3>
        <table class="table">
            <thead>
            <tr>
                <th style="width: 85%" >@lang('translation.imgName')</th>
                <th style="width: 15%">@lang('translation.action')</th>
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
                            <button type="submit" class="btn btn-danger btn-sm">@lang('translation.delete')</button>
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

h3{
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
