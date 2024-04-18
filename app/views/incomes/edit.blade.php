@extends('layouts.master')

@section('head')
{{ HTML::script('/js/fintrack.input.js') }}
<title>Finance Tracker - Edit Income</title>
@stop

@section('content')
{{ Form::open(['route'=>['income.update', $view, $income->income_id], 'class' => 'form-horizontal']) }}
    <div class="control-group">
        <label class="control-label">Date</label>
        <div class="controls">
            <input type="text" class="date-pick input-small" name="create_date" value="{{{ $income->create_date }}}"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Amount</label>
        <div class="controls">
            <input type="text" name="amount" class="focus" value="{{{ number_format($income->amount, 2, '.', '') }}}" size="12"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Description</label>
        <div class="controls">
            <textarea name="descr" cols="30" rows="5">{{{ $income->descr }}}</textarea>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">User</label>
        <div class="controls">
            {{ Form::select('user_id', $users, $income->user_id) }}
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            {{ Form::submit('Update', ['class' => 'btn btn-small btn-primary']) }}
            {{ Form::reset('Reset', ['class' => 'btn btn-small']) }}
            <a href="{{ Session::get('previous_url') }}">{{ Form::button('Back to list', ['class' => 'btn btn-small']) }}</a>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            @if($errors->has())
            @foreach($errors->all() as $error)
                <div class="error">{{ $error }}</div>
            @endforeach
            @endif
            @if(Session::has('success'))
                <div class="success">{{Session::get('success')}}</div>
            @endif
        </div>
    </div>
{{ Form::close() }}
@stop

