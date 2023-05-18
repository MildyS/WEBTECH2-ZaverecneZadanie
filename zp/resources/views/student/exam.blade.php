<!-- resources/views/student/exam.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 10px;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3 class="text">Exam</h3>
                <form action="{{ route('exam.submit') }}" method="POST" id="submitForm">
                    @csrf

                    @foreach($tasks as $task)
                        <h3 class="text">Problem:</h3>
                        <p class="task">{{ $task->task }}</p>

                        @if($task->images)
                            @php
                                $images = json_decode($task->images, true);
                            @endphp
                                <img src="{{ asset('/storage/latex_files' . $images) }}" alt="Problem image">
                        @endif
                        <br>
                        <br>
                        <!-- CORTEX CODE -->
                        <h3 class="text">Input:</h3>
                        <math-field name="solution[{{ $task->id }}]"></math-field>
                        <br>
                        <br>
                        <h3 class="text">Solution:</h3>
                        <p>${{ $task->solution }}$</p>

                        <br>
                    @endforeach

                    <button id="submitButton" type="submit" class="btn btn-primary" >Submit</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .text,
        h1{
            color: #e5e7eb;
            font-weight: bolder;
        }

        .task{
            color: #e5e7eb;
        }

    </style>

@endsection

@push('scripts')
    <script src="https://unpkg.com/mathlive"></script>

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

            const form = document.getElementById('submitForm');
            console.log("Form: ", form);  // add this line
            form.addEventListener('submit', function(e) {
                e.preventDefault();  // prevent default form submission

                // Loop through each math-field element and add its value to a hidden form field
                const mathFields = document.querySelectorAll('math-field');
                console.log("MathFields length: ", mathFields.length);
                mathFields.forEach(function(mathField) {
                    const taskId = mathField.name.match(/solution\[(\d+)\]/)[1];
                    const mathFieldValue = mathField.getValue('latex');
                    console.log(`solution[${taskId}]: ${mathFieldValue}`);
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = `solution[${taskId}]`;
                    hiddenInput.value = mathFieldValue;
                    form.appendChild(hiddenInput);
                });

                // manually submit the form
                console.log("Form submitting...");
                form.submit();
            });
        });
    </script>
@endpush



