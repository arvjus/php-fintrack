@extends('layouts.master')

@section('head')
{{ HTML::script('/js/fintrack.input.js') }}
<title>Finance Tracker - New Expense</title>
@stop

@section('content')
{{ Form::open(['route'=>['expense.save'], 'class' => 'form-horizontal']) }}
    <div class="control-group">
        <label class="control-label">Date</label>
        <div class="controls">
            <input type="text" class="date-pick input-small" name="create_date" value="{{{ $create_date }}}"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Category</label>
        <div class="controls">
            @foreach($categories as $category)
            <label class="radio">{{{ $category->name }}}
                {{ Form::radio('category_id', $category->category_id, false, ['title' => $category->descr]) }}
            </label>
            @endforeach
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Amount</label>
        <div class="controls">
            <input type="text" name="amount" class="focus" value="" size="12"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Description</label>
        <div class="controls">
            <textarea name="descr" cols="30" rows="5"></textarea>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            {{ Form::submit('Save', ['class' => 'btn btn-small btn-primary']) }}
            {{ Form::reset('Reset', ['class' => 'btn btn-small']) }}
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



