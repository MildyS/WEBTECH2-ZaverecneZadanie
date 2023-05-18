@extends('layouts.app')

@section('content')

    <div class="container" style="margin-top: 10px;">
        <div class="row justify-content-center">
            <div class="col-md-12">
    <h2>Upload LaTeX Files</h2>
                <br>
    <form action="{{ route('teacher.upload') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group" style="margin-top: 10px">
            <label for="file" style="font-size: 20px">Choose LaTeX File</label>
            <input type="file" name="file" id="file" class="form-control" required>
            @error('file')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 10px">Add Files</button>
    </form>
    <br>
    <form action="{{ route('teacher.upload_image') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image" style="font-size: 20px">Upload Image:</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 10px">Add Image</button>
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
