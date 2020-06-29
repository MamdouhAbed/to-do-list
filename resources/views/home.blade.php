@extends('layouts.app')

@section('content')

@endsection
@section('js')
    <script>
    @if (session()->has('flash_notification.success'))
        setTimeout(function () {
        new Noty({
        text: '<strong>مرحباً بك يا {{Auth::user()->name}} في لوحة التحكم </strong>! <br> تم دخولك بنجاح.',
        type: 'information',
        theme: 'mint',
        layout: 'topLeft',
        timeout: 3000
        }).show();
        }, 1500);
    </script>
    @endif
    @stop