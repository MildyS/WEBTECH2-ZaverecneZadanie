@extends('layouts.app')

@section('content')

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
    <br>

    <form action="{{ route('teacher.upload_image') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Upload Image:</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Add Image</button>
    </form>

@endsection
