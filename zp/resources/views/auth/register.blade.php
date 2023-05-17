@extends('layouts.app')


@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="container">
        <div class="row" style="text-align: center;margin-top: 40px;">
            <div class="col-md-2 col-md-offset-3 text-right">
                <strong>Select Language: </strong>
            </div>
            <div class="col-md-4">
                <select class="form-control Langchange">
                    <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="sk" {{ session()->get('locale') == 'sk' ? 'selected' : '' }}>Slovak</option>
                </select>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var url = "{{ url('change/lang') }}";
        $(".Langchange").change(function(){
            window.location.href = url + "?lang="+ $(this).val();
        });
    </script>

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div >
                <div >
                    <h3>@lang('translation.register')</h3>
                </div>
                <div class="my-element">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-4">
                            <label for="name">
                                <h5>@lang('translation.name')</h5>
                            </label>

                            <div>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="email">
                                <h5>@lang('translation.email')</h5>
                            </label>

                            <div >
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="password-confirm">
                                <h5>@lang('translation.confirmP')</h5>
                            </label>

                            <div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-4 form-group row justify-content-center ">
                            <label for="role">
                                <h5>@lang('translation.role')</h5>
                            </label>
                            <select name="role" id="role" class="form-control">
                                <option value="Student">@lang('translation.student')</option>
                                <option value="Teacher">@lang('translation.teacher')</option>
                            </select>
                        </div>

                        <div class="row mb-8">
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    @lang('translation.register')
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

    h3, h5{
        color: #e5e7eb;
        font-weight: bolder;
    }
</style>
