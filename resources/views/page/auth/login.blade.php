@extends('layout.root' )

@section('metadata')
@stop

@section('styles')
<link rel="stylesheet" href="{!! URL::asset('css/login.css') !!}">
@stop

@section('scripts')
@stop

@section('title')
    {{ config('site.name') }} | Admin | Dashboard
@stop

@section('header')
    Overview
@stop


@php $noFrame = true; @endphp
@section('content')
    <div class="login-box">
        <div class="login-box-body">
            <form action="{{ route('post-login')}}" method="post" enctype="multipart/form-data"
                  accept-charset="UTF-8">
                {!! csrf_field() !!}
                <input class="auth-input" type="email" name="email" placeholder="Email">
                <div class="notes"><i>admin.lucky.draw@gmail.com</i></div>
                <input class="auth-input" type="password" name="password" placeholder="Password"
                       autocomplete="new-password">
                <div class="notes"><i>password</i></div>
                <input type="checkbox" name="remember_me"> @lang('auth.remember_me')
                <button type="submit"
                        class="btn btn-success btn-block btn-flat">@lang('auth.login_button')</button>
            </form>
            @if(count($errors) > 0)
                <br>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Failed!</h4>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@stop
