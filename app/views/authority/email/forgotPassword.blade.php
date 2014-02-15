@extends('l.mail')
@section('container')
    <p>请点击以下链接完成密码重置：
        <br /><a href="{{ route('reset', $token) }}" target="_blank">{{ route('reset', $token) }}</a>
    </p>
@stop