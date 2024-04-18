@extends('layouts.master')

@section('head')
{{ HTML::script('/js/fintrack.input.js') }}
<title>Finance Tracker - Recently Added Expenses</title>
@stop

@section('content')
{{ $expenses->links('pagination::slider') }}
<table  class="table table-bordered table-striped table-condensed">
    <tr class="row-padded">
        <th class="text-left">Date</th>
        <th class="text-left">Amount</th>
        <th class="text-left">Category</th>
        <th class="text-left">Description</th>
        <th class="text-left">User</th>
        <th class="text-left">Edit</th>
        <th class="text-left">Delete</th>
    </tr>
    @foreach ($expenses as $expense)
    <tr class="row-padded">
            <td class="text-left">{{{ $expense->create_date }}}</td>
            <td class="text-rigth">{{{ number_format($expense->amount, 2, '.', '') }}}</td>
            <td class="text-left">{{{ $expense->category->name_short }}}</td>
            <td class="text-left">{{{ $expense->descr }}}</td>
            <td class="text-left">{{{ $expense->user->username }}}</td>
            <td class="text-left">{{ HTML::linkRoute('expense.edit', 'Edit', ['recent', $expense->expense_id], ['class' => 'btn btn-mini'])}}</td>
            <td class="text-left">{{ HTML::linkRoute('expense.delete', 'Delete', $expense->expense_id, ['class' => 'btn btn-mini btn-danger confirmation'])}}</td>
        </tr>
    @endforeach
</table>
<br>
@if($errors->has())
    @foreach($errors->all() as $error)
        <div class="error">{{ $error }}</div>
    @endforeach
@endif
@if(Session::has('success'))
    <div class="success">{{Session::get('success')}}</div>
@endif
@stop
