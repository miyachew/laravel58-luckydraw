<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lucky Draw</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @include('layout.metadata')
    @include('layout.style')
    @yield('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@if(isset($noFrame) && $noFrame == true)
    @yield('content')
@else
    @include('layout.frame')
@endif

<div id="app"></div>

@include('layout.scripts')
@yield('scripts')
</body>
</html>
