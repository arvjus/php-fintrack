@extends('layouts.master')

@section('head')
{{ HTML::style('/css/jquery.jqplot.css') }}
{{ HTML::script('/js/jquery.jqplot.min.js') }}
{{ HTML::script('/js/jqplot.categoryAxisRenderer.min.js') }}
{{ HTML::script('/js/jqplot.barRenderer.min.js') }}
{{ HTML::script('/js/fintrack.summary.js') }}
<title>Finance Tracker - Summary</title>
@stop

@section('refinements')
{{$refinements}}
@stop

@section('content')
@if ($plot_chart)
    <div class="summary-chart jqPlot" id="summary-total-chart" style="height:0px; width:800px;"></div>
    <br/>
@endif
<table  class="table table-bordered table-striped table-condensed">
    <tr class="row-padded">
        <th class="text-left">Incomes</th>
        <th class="text-left">Count</th>
        <th class="text-left">Amount</th>
        <th class="text-left">Expenses</th>
        <th class="text-left">Count</th>
        <th class="text-left">Amount</th>
    </tr>
    <tr class="total_values row-padded">
        <td class="text-left">Total</td>
        <td class="text-right">{{{ $incomes_total->count }}}</td>
        <td class="text-right">{{{ number_format($incomes_total->amount, 2, '.', '') }}}</td>
        <td class="text-left">Total</td>
        <td class="text-right">{{{ $expenses_total->count }}}</td>
        <td class="text-right">{{{ number_format($expenses_total->amount, 2, '.', '') }}}</td>
    </tr>
</table>
<br/>
@if ($groupped_by == 'categories')
    @if ($plot_chart)
        <div class="summary-chart jqPlot" id="summary-categories-chart" style="height:0px; width:800px;"></div>
        <br/>
    @endif
    <br/>
    <table  class="table table-bordered table-striped table-condensed">
        <tr>
            <th class="text-left">Category</th>
            <th class="text-left">Count</th>
            <th class="text-left">Amount</th>
        </tr>
        @foreach ($expenses as $expense)
            <tr class="category_values">
                <td class="text-left">{{{ $expense->group }}}</td>
                <td class="text-left">{{{ $expense->count }}}</td>
                <td class="text-right">{{{ number_format($expense->amount, 2, '.', '') }}}</td>
            </tr>
        @endforeach
    </table>
@endif
@if ($groupped_by == 'months')
    @if ($plot_chart)
        <div class="summary-chart jqPlot" id="summary-months-chart" style="height:0px; width:800px;"></div>
        <br/>
    @endif
    <table  class="table table-bordered table-striped table-condensed">
        <tr>
            <th class="text-left">Incomes</th>
            <th class="text-left">Count</th>
            <th class="text-left">Amount</th>
            <th class="text-left">Expences</th>
            <th class="text-left">Count</th>
            <th class="text-left">Amount</th>
        </tr>
        @foreach ($summary as $item)
            <tr class="month_values">
                <td class="text-left">{{{ $item->yyyymm }}}</td>
                <td class="text-left">{{{ $item->income->count }}}</td>
                <td class="text-right">{{{ number_format($item->income->amount, 2, '.', '') }}}</td>
                <td class="text-left">{{{ $item->yyyymm }}}</td>
                <td class="text-left">{{{ $item->expense->count }}}</td>
                <td class="text-right">{{{ number_format($item->expense->amount, 2, '.', '') }}}</td>
            </tr>
        @endforeach
    </table>
@endif
@stop
