<?php

use LaravelBook\Ardent\Ardent;

class Income extends Ardent
{
    public $timestamps = false;
    protected $primaryKey = 'income_id';
    protected $guarded = array('income_id');

    public function user() {
        return $this->belongsTo('user', 'user_id');
    }

    /**
     * Ardent validation rules
     */
    public static $rules = array(
        'create_date' => 'required|date_format:Y-m-d',
        'amount' => 'required|numeric|min:1.0',
        'descr' => 'max:50',
        'user_id' => 'required'
    );
}