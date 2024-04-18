<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="icon" href="/favicon.ico">
    {{ HTML::style('/css/bootstrap.css') }}
    {{ HTML::style('/css/fintrack.css') }}
    {{ HTML::script('/js/jquery-1.4.2.min.js') }}
    {{ HTML::script('/js/date.js') }}
    {{ HTML::script('/js/fintrack.js') }}
    @yield('head')
</head>

<body>
<div class="container">
    <div class="navbar navbar-inner">
        <span class="navbar-text caption">Financial Tracker</span>
        <span class="navbar-text pull-right">
                @if(Auth::check())
                    Logged in as {{Auth::user()->username}} {{HTML::linkRoute('logout', 'Logout')}}
                @else
                    {{HTML::linkRoute('login', 'Login')}}
                @endif
        </span>
    </div>




    <div class="row">
        <div class="span2">
            <ul class="nav nav-list">
                <li data-frag="income/new">{{HTML::linkRoute('income.new', 'Add income')}}</li>
                <li data-frag="income/recent">{{HTML::linkRoute('income.recent', 'Recent income')}}</li>
                <li data-frag="income/list">{{HTML::linkRoute('income.list', 'List income')}}</li>
                <li data-frag="expense/new">{{HTML::linkRoute('expense.new', 'Add expense')}}</li>
                <li data-frag="expense/recent">{{HTML::linkRoute('expense.recent', 'Recent expenses')}}</li>
                <li data-frag="expense/list">{{HTML::linkRoute('expense.list', 'List expenses')}}</li>
                <li data-frag="summary">{{HTML::linkRoute('summary', 'Summary')}}</li>
            </ul>
            <div class="refinements">
                @yield('refinements')
            </div>
        </div>
        <div class="span10">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
