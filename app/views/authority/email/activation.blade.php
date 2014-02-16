@extends('l.mail')
@section('container')
    <p>感谢您注册 Simple - Blog，请点击以下链接激活您的账号：
        <br /><a href="{{ route('activate', $activationCode) }}" target="_blank">{{ route('activate', $activationCode) }}</a>
    </p>
@stop