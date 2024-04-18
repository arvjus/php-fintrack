@extends('layouts.master')

@section('head')
<title>Finance Tracker</title>
@stop

@section('content')
@if(Auth::check())
Welcome {{ Auth::user()->username }}!
@else
Welcome! Please, {{HTML::linkRoute('login', 'login')}}
@endif
@stop

