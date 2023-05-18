@extends('layouts.app')

@section('content')

{{--    <!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
{{--    </head>--}}
{{--<body>--}}
{{--    <div class="container">--}}
{{--        <div class="row" style="text-align: center;margin-top: 40px;">--}}
{{--            <div class="col-md-2 col-md-offset-3 text-right">--}}
{{--                <strong>Select Language: </strong>--}}
{{--            </div>--}}
{{--            <div class="col-md-4">--}}
{{--                <select class="form-control changeLang">--}}
{{--                    <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>--}}
{{--                    <option value="sk" {{ session()->get('locale') == 'sk' ? 'selected' : '' }}>Slovak</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</body>--}}
{{--    <script type="text/javascript">--}}
{{--        var url = "{{ route('changeLang') }}";--}}

{{--[]--}}

{{--        $(".changeLang").change(function(){--}}

{{--            window.location.href = url + "?lang="+ $(this).val();--}}

{{--        });--}}
{{--    </script>--}}
{{--</html>--}}

<div class="container" style="margin-top: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div>
                <div>
                    <h3>@lang('translation.login')</h3>
                </div>
                <div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-4">
                            <label for="email">
                                <h5>@lang('translation.email')</h5>
                            </label>

                            <div >
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="password">
                                <h5>@lang('translation.password')</h5>
                            </label>

                            <div >
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    @lang('translation.login')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>

    h3, h5,
    .remember,
    .forgotPassword{
        color: #e5e7eb;
        font-weight: bolder;
    }

    .btn-link {
        text-decoration: none;
        padding-left: 0px;
    }

    .btn-link :hover{
        color: #da3c8b;
        text-shadow: 0 0 1px #da3c8b;
    }
</style>

