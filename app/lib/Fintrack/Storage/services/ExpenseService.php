<?php namespace Fintrack\Storage\Services;

use Expense;
use Beans\SummaryBean;

class ExpenseService
{
    public function paginate($page) {
       return Expense::orderBy('create_date', 'DESC')->paginate($page);
    }

    public function plain($page, $date_from, $date_to, $category_ids = array(), $user_id = 0) {
        $query = Expense::whereBetween('create_date', array($date_from, $date_to));
        if (count($category_ids) > 0) {
            $query = $query->whereRaw("category_id in ('" . implode("','", $category_ids) . "')");
        }
        if ($user_id) {
            $query = $query->where('user_id', '=', $user_id);
        }
        return $query->orderBy('create_date', 'DESC')->paginate($page);
    }

    public function summaryByCategory($date_from, $date_to, $category_ids = array()) {
        $where_categories = '';
        if (count($category_ids) > 0) {
            $where_categories = " AND e.category_id in ('" . implode("','", $category_ids) . "')";
        }

        $results = \DB::select(
            \DB::raw('SELECT COUNT(e.expense_id) AS count, SUM(e.amount) AS amount, c.name AS grp ' .
                ' FROM expenses e, categories c ' .
                'WHERE c.category_id = e.category_id ' .
                '  AND e.create_date BETWEEN ? AND ? ' . $where_categories .
                'GROUP BY c.name ' .
                'ORDER BY c.name '),
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

    public function summaryByMonth($date_from, $date_to, $category_ids = array()) {
        $where_categories = '';
        if (count($category_ids) > 0) {
            $where_categories = " AND category_id in ('" . implode("','", $category_ids) . "')";
        }

        $results = \DB::select(
            \DB::raw('SELECT COUNT(expense_id) AS count, SUM(amount) AS amount, SUBSTRING(create_date, 1, 7) AS grp ' .
                ' FROM expenses ' .
                'WHERE create_date BETWEEN ? AND ? ' . $where_categories .
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