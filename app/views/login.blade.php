@extends('layouts.master')

@section('head')
<title>Finance Tracker</title>
@stop

@section('content')
{{ Form::open(['route'=>['login'], 'class' => 'form-horizontal']) }}
    <div class="control-group">
        <label class="control-label">User name</label>
        <div class="controls">
            {{ Form::text('username', Input::old('username')) }}
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Password</label>
        <div class="controls">
            {{ Form::password('password') }}
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            {{ Form::submit('Login', ['class' => 'btn btn-small btn-primary']) }}
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            @if (Session::has('error'))
                <div class="error">{{ Session::get('error') }}</div>
            @endif
        </div>
    </div>
{{ Form::close() }}
@stop
