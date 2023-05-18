@extends('layouts.app')

@section('content')

    <div class="container">
        <h3 class="results">@lang('translation.examResults')</h3>
        <div class="text">
            @lang('translation.pointsScored') {{ $correctPoints }}
        </div>
        <div class="text">
            @lang('translation.tpp') {{ $totalPoints }}
        </div>

        <a href="{{ route('student') }}" class="btn btn-primary">@lang('translation.backToHome')</a>
    </div>

@endsection
<style>
    .results,
    .text{
        color: #e5e7eb;
        font-weight: bolder;
    }
</style>
