<?php

use LaravelBook\Ardent\Ardent;

class Expense extends Ardent
{
    public $timestamps = false;
    protected $primaryKey = 'expense_id';
    protected $guarded = array('expense_id');

    public function category() {
        return $this->belongsTo('Category', 'category_id');
    }

    public function user() {
        return $this->belongsTo('user', 'user_id');
    }

    /**
     * Ardent validation rules
     */
    public static $rules = array(
        'create_date' => 'required|date_format:Y-m-d',
        'category_id' => 'required|size:2',
        'amount' => 'required|numeric|min:1.0',
        'descr' => 'max:50',
        'user_id' => 'required'
    );
}

