@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('auth.verify_email')</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            @lang('auth.verify_refresh')
                        </div>
                    @endif

                    @lang('auth.verify_check_your_email')
                    @lang('auth.verify_not_receive'), <a href="{{ route('verification.resend') }}">@lang('auth.verify_request_repeatedly')</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
