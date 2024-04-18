<?php namespace Fintrack\Storage\Services;

use Income;
use Beans\SummaryBean;

class IncomeService
{
    public function paginate($page) {
        return Income::orderBy('create_date', 'DESC')->paginate($page);
    }

    public function plain($page, $date_from, $date_to, $user_id = 0) {
        $query = Income::whereBetween('create_date', array($date_from, $date_to));
        if ($user_id) {
            $query = $query->where('user_id', '=', $user_id);
        }
        return $query->orderBy('create_date', 'DESC')->paginate($page);
    }

    public function summarySimple($date_from, $date_to) {
        $results = \DB::select(
            \DB::raw('SELECT COUNT(income_id) AS count, SUM(amount) AS amount ' .
                     'FROM incomes ' .
                     'WHERE create_date BETWEEN ? AND ?'),
                array($date_from, $date_to)
            );

        $summaries = array();
        if (count($results) > 0) {
            foreach ($results as $result) {
                $summaries[] = new SummaryBean($result->count, $result->amount);
            }
        }
        return $summaries;
    }

    public function summaryByMonth($date_from, $date_to) {
        $results = \DB::select(
            \DB::raw('SELECT COUNT(income_id) AS count, SUM(amount) AS amount, SUBSTRING(create_date, 1, 7) AS grp ' .
                     'FROM incomes ' .
                     'WHERE create_date BETWEEN ? AND ? ' .
                     'GROUP BY SUBSTRING(create_date, 1, 7)' .
                     'ORDER BY SUBSTRING(create_date, 1, 7)'),
                array($date_from, $date_to)
            );

        $summaries = array();
        if (count($results) > 0) {
            foreach ($results as $result) {
                $summaries[] = new SummaryBean($result->count, $result->amount, $result->grp);
            }
        }
        return $summaries;
    }
}