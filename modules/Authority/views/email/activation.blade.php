@extends('l.mail')
@section('container')
    <p>感谢您注册 Demo，请点击以下链接完成注册：
        <br /><a href="{{ route('activate', $activationCode) }}" target="_blank">{{ route('activate', $activationCode) }}</a>
    </p>
@stop