<?php

/* Model Bindings */
Route::model('income', 'Income');
Route::model('expense', 'Expense');

/* Public access */
Route::get('/', function() {
    return View::make('home');
});

/* Login routes */
Route::get('login', ['as' => 'login', 'uses' => 'LoginController@getIndex'])->before('guest');
Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout'])->before('auth');
Route::post('login', ['as' => 'login', 'uses' => 'LoginController@login']);

/* Routes requiring login */
Route::group(['before' => 'auth'], function () {
    /* GET routes */
    Route::get('income/recent', ['as' => 'income.recent', 'uses' => 'IncomeController@recentIncome']);
    Route::get('income/list', ['as' => 'income.list', 'uses' => 'IncomeController@listIncome']);
    Route::get('income/new', ['as' => 'income.new', 'uses' => 'IncomeController@newIncome']);
    Route::get('income/{view}/{income}/edit', ['as' => 'income.edit', 'uses' => 'IncomeController@editIncome']);
    Route::get('income/{income}/delete', ['as' => 'income.delete', 'uses' => 'IncomeController@deleteIncome']);

    Route::get('expense/recent', ['as' => 'expense.recent', 'uses' => 'ExpenseController@recentExpense']);
    Route::get('expense/list', ['as' => 'expense.list', 'uses' => 'ExpenseController@listExpense']);
    Route::get('expense/new', ['as' => 'expense.new', 'uses' => 'ExpenseController@newExpense']);
    Route::get('expense/{view}/{expense}/edit', ['as' => 'expense.edit', 'uses' => 'ExpenseController@editExpense']);
    Route::get('expense/{expense}/delete', ['as' => 'expense.delete', 'uses' => 'ExpenseController@deleteExpense']);

    Route::get('summary', ['as' => 'summary', 'uses' => 'SummaryController@getIndex']);

    /* POST routes */
    Route::post('income/save', ['as' => 'income.save', 'uses' => 'IncomeController@saveIncome']);
    Route::post('income/{view}/{income}/update', ['as' => 'income.update', 'uses' => 'IncomeController@updateIncome']);

    Route::post('expense/save', ['as' => 'expense.save', 'uses' => 'ExpenseController@saveExpense']);
    Route::post('expense/{view}/{expense}/update', ['as' => 'expense.update', 'uses' => 'ExpenseController@updateExpense']);
});
