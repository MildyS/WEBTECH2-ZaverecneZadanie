@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 10px;">
        <div class="row justify-content-center">
            <div class="col-md-12">
    <h3>@lang('translation.uploadLat')</h3>
    <form action="{{ route('teacher.upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group" style="margin-top: 10px">
            <label for="file" style="font-size: 20px">@lang('translation.choose')</label>
            <input type="file" name="file" id="file" class="form-control" required>
            @error('file')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group" style="margin-top: 10px">
            <label for="points" style="font-size: 20px">@lang('translation.ppp')</label>
            <input type="number" name="points" id="points" class="form-control" required>
            @error('points')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 10px">@lang('translation.addFiles')</button>
    </form>
    <br>
    <form action="{{ route('teacher.upload_image') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image" style="font-size: 20px">@lang('translation.uploadImg')</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 10px">@lang('translation.addImg')</button>
    </form>
            </div>
        </div>
    </div>
@endsection

<style>

    .container{
        color: #e5e7eb;
    }

    .btn-link :hover{
        color: #da3c8b;
        text-shadow: 0 0 1px #da3c8b;
    }
</style>
