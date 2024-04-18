<?php

use Fintrack\Storage\Services\CategoryService as CategoryService;
use Fintrack\Storage\Services\IncomeService as IncomeService;
use Fintrack\Storage\Services\ExpenseService as ExpenseService;
use Fintrack\Storage\Services\DataAggregationService as DataAggregationService;

class SummaryController extends \BaseController {
    public function __construct(
        CategoryService $categoryService,
        IncomeService $incomeService,
        ExpenseService $expenseService,
        DataAggregationService $dataAggregationService) {
        $this->categoryService = $categoryService;
        $this->incomeService = $incomeService;
        $this->expenseService = $expenseService;
        $this->dataAggregationService = $dataAggregationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex() {
        $date_from = Input::get('date_from', date('Y-01-01', time()));
        $date_to = Input::get('date_to', date('Y-m-d', time()));
        $income_selected = Input::get('income_selected', false);
        $category_ids = Input::get('category_ids', array());
        $categories = $this->categoryService->all();
        $groupped_by = Input::get('groupped_by', 'categories');
        $plot_chart = Input::get('plot_chart', false);

        $incomes = array();
        $expenses = array();
        if ($groupped_by == 'categories') {
            if ($income_selected || count($category_ids) == 0) {
                $incomes = $this->incomeService->summarySimple($date_from, $date_to);
            }
            if (count($category_ids) > 0 || !$income_selected) {
                $expenses = $this->expenseService->summaryByCategory($date_from, $date_to, $category_ids);
            }
        } else if ($groupped_by == 'months') {
            if ($income_selected || count($category_ids) == 0) {
                $incomes = $this->incomeService->summaryByMonth($date_from, $date_to);
            }
            if (count($category_ids) > 0 || !$income_selected) {
                $expenses = $this->expenseService->summaryByMonth($date_from, $date_to, $category_ids);
            }
        }

        $incomes_total = $this->dataAggregationService->total($incomes);
        $expenses_total = $this->dataAggregationService->total($expenses);
        $summary = $this->dataAggregationService->joinSummary($incomes, $expenses);

        $this->layout->main = View::make('summary', compact('groupped_by', 'plot_chart', 'incomes', 'incomes_total', 'expenses', 'expenses_total', 'summary'))->
            nest('refinements', 'refinements.summary', compact('date_from', 'date_to', 'income_selected', 'category_ids', 'categories', 'groupped_by', 'plot_chart'));
    }
}
