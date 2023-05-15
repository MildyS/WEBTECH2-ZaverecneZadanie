<!-- resources/views/student/exam.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Exam</h1>

        @foreach($tasks as $task)
            <h2>Problem:</h2>
            <p>{{ $task->task }}</p>

            @if($task->images)
                <img src="{{ asset('/storage/latex_files' . $task->images) }}" alt="Problem image">
            @endif
            <br>
            <br>
            <h2>Solution:</h2>
            <p>${{ $task->solution }}$</p>
        @endforeach
    </div>

@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.7/dist/katex.min.css" integrity="sha384-3UiQGuEI4TTMaFmGIZumfRPtfKQ3trwQE2JgosJxCnGmQpL/lJdjpcHkaaFwHlcI" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.7/dist/katex.min.js" integrity="sha384-G0zcxDFp5LWZtDuRMnBkk3EphCK1lhEf4UEyEM693ka574TZGwo4IWwS6QLzM/2t" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.7/dist/contrib/auto-render.min.js" integrity="sha384-+VBxd3r6XgURycqtZ117nYw44OOcIax56Z4dCRWbxyPt0Koah1uHoK0o4+/RRE05" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            renderMathInElement(document.body, {
                delimiters: [
                    {left: "$$", right: "$$", display: true},
                    {left: "$", right: "$", display: false},
                ]
            });
        });
    </script>
@endpush
