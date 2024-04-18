@extends('layouts.master')

@section('head')
{{ HTML::script('/js/fintrack.input.js') }}
<title>Finance Tracker - Recently Added Income</title>
@stop

@section('content')
{{ $incomes->links('pagination::slider') }}
<table  class="table table-bordered table-striped table-condensed">
    <tr class="row-padded">
        <th class="text-left">Date</th>
        <th class="text-left">Amount</th>
        <th class="text-left">Description</th>
        <th class="text-left">User</th>
        <th class="text-left">Edit</th>
        <th class="text-left">Delete</th>
    </tr>
    @foreach ($incomes as $income)
    <tr class="row-padded">
        <td class="text-left">{{{ $income->create_date }}}</td>
        <td class="text-right">{{{ number_format($income->amount, 2, '.', '') }}}</td>
        <td class="text-left">{{{ $income->descr }}}</td>
        <td class="text-left">{{{ $income->user->username }}}</td>
        <td class="text-left">{{ HTML::linkRoute('income.edit', 'Edit', ['recent', $income->income_id], ['class' => 'btn btn-mini'])}}</td>
        <td class="text-left">{{ HTML::linkRoute('income.delete', 'Delete', $income->income_id, ['class' => 'btn btn-mini btn-danger confirmation'])}}</td>
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
    <div class="success">{{ Session::get('success') }}</div>
@endif
@stop
