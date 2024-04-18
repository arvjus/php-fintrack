<?php namespace Beans;

class SummaryBean {
    public $count;
    public $amount;
    public $group;

    public function __construct($count, $amount, $group = null) {
        $this->count = $count;
        $this->amount = $amount;
        $this->group = $group;
    }

} 