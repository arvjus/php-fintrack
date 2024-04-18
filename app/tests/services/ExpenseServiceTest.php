<?php

use Fintrack\Storage\Services\ExpenseService;
use Beans\SummaryBean;


// category_id	create_date	amount	descr
// fd	2010-01-01	55.75	McDonald's
// fd	2010-02-01	123.45	Sausages
// el	2010-01-01	4500.00	new iPhone
// hh	2010-02-10	100.00	toapapper

class ExpenseServiceTest extends TestCase {
    public function setUp() {
        parent::setUp();

        $this->service = new ExpenseService();
        $this->date1 = date('Y-m-d', strtotime('2010-01-01'));
        $this->date2 = date('Y-m-d', strtotime('2010-02-10'));
    }

    public function testGetLimitedToPage() {
        $expenses = $this->service->paginate(2);
        $this->assertNotNull($expenses);
        $this->assertEquals(2, count($expenses));
    }

    public function testGetPlainAll() {
        $expenses = $this->service->plain(10, $this->date1, $this->date2);
        $this->assertNotNull($expenses);
        $this->assertEquals(4, count($expenses));
    }

    public function testGetPlainLimitedByDate() {
        $expenses = $this->service->plain(10, $this->date1, $this->date1);
        $this->assertNotNull($expenses);
        $this->assertEquals(2, count($expenses));
    }

    public function testGetPlainLimitedByCategories() {
        $expenses = $this->service->plain(10, $this->date1, $this->date2, array('fd', 'el'));
        $this->assertNotNull($expenses);
        $this->assertEquals(3, count($expenses));
    }

    public function testGetPlainLimitedByDateAndCategories() {
        $expenses = $this->service->plain(10, $this->date1, $this->date1, array('fd', 'el'));
        $this->assertNotNull($expenses);
        $this->assertEquals(2, count($expenses));
    }

    public function testSummaryByCategoriesAll() {
        $summaries = $this->service->summaryByCategory($this->date1, $this->date2);
        $this->assertNotNull($summaries);
        $this->assertEquals(3, count($summaries), 'count($summaries)');
        foreach($summaries as $summary) {
            $this->assertTrue($summary instanceof SummaryBean);
            if ($summary->group == 'Food') {
                $this->assertEquals(2, $summary->count);
                $this->assertEquals(179.2, round($summary->amount, 2));
            } elseif ($summary->group == 'Electronics') {
                $this->assertEquals(1, $summary->count);
                $this->assertEquals(4500.0, round($summary->amount, 2));
            } elseif ($summary->group == 'Houshold') {
                $this->assertEquals(1, $summary->count);
                $this->assertEquals(100.0, round($summary->amount, 2));
            }
        }
    }

    public function testSummaryByCategoriesLimitedByDate() {
        $summaries = $this->service->summaryByCategory($this->date1, $this->date1);
        $this->assertNotNull($summaries);
        $this->assertEquals(2, count($summaries), 'count($summaries)');
        foreach($summaries as $summary) {
            $this->assertTrue($summary instanceof SummaryBean);
            if ($summary->group == 'Food') {
                $this->assertEquals(1, $summary->count);
                $this->assertEquals(55.75, round($summary->amount, 2));
            } elseif ($summary->group == 'Electronics') {
                $this->assertEquals(1, $summary->count);
                $this->assertEquals(4500.0, round($summary->amount, 2));
            }
        }
    }

    public function testSummaryByCategoriesLimitedByCategories() {
        $summaries = $this->service->summaryByCategory($this->date1, $this->date2, array('fd', 'hh'));
        $this->assertNotNull($summaries);
        $this->assertEquals(2, count($summaries), 'count($summaries)');
        foreach($summaries as $summary) {
            $this->assertTrue($summary instanceof SummaryBean);
            if ($summary->group == 'Food') {
                $this->assertEquals(2, $summary->count);
                $this->assertEquals(179.2, round($summary->amount, 2));
            } elseif ($summary->group == 'Houshold') {
                $this->assertEquals(1, $summary->count);
                $this->assertEquals(100.0, round($summary->amount, 2));
            }
        }
    }

    public function testSummaryByCategoriesLimitedByDateAndCategories() {
        $summaries = $this->service->summaryByCategory($this->date1, $this->date1, array('fd', 'hh'));
        $this->assertNotNull($summaries);
        $this->assertEquals(1, count($summaries), 'count($summaries)');
        foreach($summaries as $summary) {
            $this->assertTrue($summary instanceof SummaryBean);
            if ($summary->group == 'Food') {
                $this->assertEquals(1, $summary->count);
                $this->assertEquals(55.75, round($summary->amount, 2));
            }
        }
    }

    public function testSummaryByMonthAll() {
        $summaries = $this->service->summaryByMonth($this->date1, $this->date2);
        $this->assertNotNull($summaries);
        $this->assertEquals(2, count($summaries), 'count($summaries)');
        foreach($summaries as $summary) {
            $this->assertTrue($summary instanceof SummaryBean);
            if ($summary->group == '2010-01') {
                $this->assertEquals(2, $summary->count);
                $this->assertEquals(4555.75, round($summary->amount, 2));
            } elseif ($summary->group == '2010-02') {
                $this->assertEquals(2, $summary->count);
                $this->assertEquals(223.45, round($summary->amount, 2));
            }
        }
    }

    public function testSummaryByMonthLimitedByDate() {
        $summaries = $this->service->summaryByMonth($this->date1, $this->date1);
        $this->assertNotNull($summaries);
        $this->assertEquals(1, count($summaries), 'count($summaries)');
        $summary = $summaries[0];
        $this->assertTrue($summary instanceof SummaryBean);
        $this->assertEquals('2010-01', $summary->group);
        $this->assertEquals(2, $summary->count);
        $this->assertEquals(4555.75, round($summary->amount, 2));
    }

    public function testSummaryByMonthLimitedByCategories() {
        $summaries = $this->service->summaryByMonth($this->date1, $this->date2, array('fd', 'hh'));
        $this->assertNotNull($summaries);
        $this->assertEquals(2, count($summaries), 'count($summaries)');
        foreach($summaries as $summary) {
            $this->assertTrue($summary instanceof SummaryBean);
            if ($summary->group == '2010-01') {
                $this->assertEquals(1, $summary->count);
                $this->assertEquals(55.75, round($summary->amount, 2));
            } elseif ($summary->group == '2010-02') {
                $this->assertEquals(2, $summary->count);
                $this->assertEquals(223.45, round($summary->amount, 2));
            }
        }
    }

    public function testSummaryByMonthLimitedByDateAndCategories() {
        $summaries = $this->service->summaryByMonth($this->date1, $this->date1, array('fd', 'hh'));
        $this->assertNotNull($summaries);
        $this->assertEquals(1, count($summaries), 'count($summaries)');
        foreach($summaries as $summary) {
            $this->assertTrue($summary instanceof SummaryBean);
            if ($summary->group == '2010-01') {
                $this->assertEquals(1, $summary->count);
                $this->assertEquals(55.75, round($summary->amount, 2));
            }
        }
    }

}