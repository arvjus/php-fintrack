<?php

use LaravelBook\Ardent\Ardent;

class Category extends Ardent
{
    public $timestamps = false;
    protected $primaryKey = 'category_id';
    protected $guarded = array('category_id');

    public function expenses() {
        return $this->hasMany('Expense');
    }

    /**
     * Ardent validation rules
     */
    public static $rules = array(
        'category_id' => 'required|size:2',
        'name' => 'required|between:4,20',
        'name_short' => 'required|between:4,15',
        'order_pos' => 'max:9',
        'descr' => 'required|between:4,60'
    );
}
