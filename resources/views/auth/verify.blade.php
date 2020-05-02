@extends('layouts.admin')
@section('contents')
<div class="page-content fade-in-up">
    @if (session('resent'))
        <div class="alert alert-success alert-dismissable fade show alert-outline has-icon">
            <i class="la la-check alert-icon"></i>
            <button class="close" data-dismiss="alert" aria-label="Close"></button><strong>{{ __('Success!') }}</strong><br>{{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif
    <div class="alert alert-primary alert-dismissable fade show">
        <h4>{{ __('Email Verification!') }}</h4>
        <p>{{ __('Before proceeding, please check your email for a verification link. If you did not receive the email, please click the resend button to get another verification link.') }}</p>
        <p>
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button class="btn btn-success btn-sm mr-2" type="submit">{{ __('Resend Verification Link') }}</button>
            </form>
        </p>
    </div>
</div>
@endsection