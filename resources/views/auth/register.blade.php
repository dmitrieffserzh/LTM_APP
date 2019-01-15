@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('auth.register')</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right col-form-label-sm">@lang('auth.register_username')</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control form-control-sm{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}"
                                       data-toggle="tooltip" data-placement="right" required autofocus>
                                <span class="valid-feedback" role="alert">
                                    Логин свободен!
                                </span>
                                <span class="invalid-feedback" role="alert">
                                </span>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right col-form-label-sm">@lang('auth.register_email')</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control form-control-sm{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right col-form-label-sm">@lang('auth.register_password')</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control form-control-sm{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right col-form-label-sm">@lang('auth.register_password_confirmation')</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control form-control-sm" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('auth.register')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let timer = null;

    $('#username').on('keyup', function () {

        let input = $(this);

        clearTimeout(timer);
        timer = setTimeout(function () {

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: input,
                type: 'POST',
                url: '/check_username',
                success: function (result) {

                    let mainStat    = (result.success) ? 'is-valid' : 'is-invalid';
                    let oldStat     = (result.success) ? 'is-invalid' : 'is-valid';
                    let errorMes    = result.error.join(' ') || '';

                    if(input.hasClass(oldStat))
                        input.removeClass(oldStat);

                    input.addClass(mainStat);
                    input.parent().find('.invalid-feedback').text(errorMes);
                }
            });

        }, 500);
    })
</script>
@endsection
