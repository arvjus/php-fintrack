<?php namespace Fintrack\Storage\Services;

use Beans\SummaryBean;
use MyProject\Proxies\__CG__\OtherProject\Proxies\__CG__\stdClass;

class DataAggregationService
{
    private static $mapping = array('01' => 'jan', '02' => 'feb', '03' => 'mar', '04' => 'apr', '05' => 'maj',
        '06' => 'jun', '07' => 'jul', '08' => 'aug', '09' => 'sep', '10' => 'okt', '11' => 'nov', '12' => 'dec');

    public function total($beans) {
        $count = 0;
        $amount = 0;
        foreach($beans as $bean) {
            $count += $bean->count;
            $amount += $bean->amount;
        }
        return new SummaryBean($count, $amount);
    }

    /*
     * Join two set results by filling empty gaps.
     * Result is presented as list of stdClass with month, income, expense values. List is ordered by month field.
     * returns a list of maps.
     */
    public function joinSummary($incomes, $expenses) {
        // collect all groups, beans
        $groups = array();
        $beans = array();
        foreach ($incomes as $income) {
            $groups[] = $income->group;
            $beans['i' . $income->group] = $income;
        }
        foreach ($expenses as $expense) {
            $groups[] = $expense->group;
            $beans['e' . $expense->group] = $expense;
        }
        $groups = array_unique($groups);

        // put beans into maps, list
        $list = array();
        foreach ($groups as $group) {
            $obj = new \stdClass();
            $obj->yyyymm = $group;
            $obj->month = $this->yyyymm2month($group);
            if (array_key_exists('i' . $group, $beans)) {
                $obj->income = $beans['i' . $group];
            } else {
                $obj->income = new SummaryBean(0, 0.0, $group);
            }
            if (array_key_exists('e' . $group, $beans)) {
                $obj->expense = $beans['e' . $group];
            } else {
                $obj->expense = new SummaryBean(0, 0.0, $group);
            }
            $list[] = $obj;
        }
        return $list;
    }

    public function yyyymm2month($yyyymm) {
        if (strlen($yyyymm) == 6) {
            $month = substr($yyyymm, 4);
            if (array_key_exists($month, self::$mapping)) {
                return self::$mapping[$month];
            }
        }
		return $yyyymm;
	}
} 