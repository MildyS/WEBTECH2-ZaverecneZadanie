<!-- resources/views/student.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 10px;">
        <h1>@lang('translation.dashboardStudent')</h1>

        <h3 style="margin-bottom: 10px">@lang('translation.publishedFiles')</h3>

        <form method="POST" action="{{ route('student.startExam') }}">
            <br>
            @csrf

            @foreach($publishedFiles as $file)
                @if(!in_array($file->id, $finishedFileIds))
                    <div>
                        <input type="checkbox" id="file-{{ $file->id }}" name="selected_files[]" value="{{ $file->id }}">
                        <label for="file-{{ $file->id }}">{{ $file->file_name }}</label>
                    </div>
                @endif
            @endforeach

            <button type="submit" class="btn btn-primary" style="margin-top: 20px">@lang('translation.startExam')</button>
        </form>

        <h3 style="margin-bottom: 10px">@lang('translation.ff')</h3>

        @if($finishedFiles->isNotEmpty())
            <table class="table table-dark table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">@lang('translation.fileName')</th>
                    <th scope="col">@lang('translation.points')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($finishedFiles as $index => $finishedFile)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $finishedFile->file->file_name }}</td>
                        <td>{{ $finishedFile->points }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>@lang('translation.nffy')</p>
        @endif


    </div>
@endsection


<style>
    h1, h3{
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
