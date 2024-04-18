<?php

use Fintrack\Storage\Services\IncomeService;
use Beans\SummaryBean;

// create_date	amount	descr
// 2010-01-01	12345.67	Salary
// 2010-01-01	200.50	Books on eBay
// 2010-02-10	500.10	Extra jobb

class IncomeServiceTest extends TestCase {
    public function setUp() {
        parent::setUp();

        $this->service = new IncomeService();
        $this->date1 = date('Y-m-d', strtotime('2010-01-01'));
        $this->date2 = date('Y-m-d', strtotime('2010-02-10'));
    }

    public function testGetLimitedByPage() {
        $incomes = $this->service->paginate(2);
        $this->assertNotNull($incomes);
        $this->assertEquals(2, count($incomes));
    }

    public function testGetPlainAll() {
        $incomes = $this->service->plain(10, $this->date1, $this->date2);
        $this->assertNotNull($incomes);
        $this->assertEquals(3, count($incomes));
    }

    public function testGetPlainLimitedByDate() {
        $incomes = $this->service->plain(10, $this->date1, $this->date1);
        $this->assertNotNull($incomes);
        $this->assertEquals(2, count($incomes));
    }

    public function testSummarySimpleAll() {
        $summaries = $this->service->summarySimple($this->date1, $this->date2);
        $this->assertNotNull($summaries);
        $this->assertEquals(1, count($summaries));
        $summary = $summaries[0];
        $this->assertTrue($summary instanceof SummaryBean);
        $this->assertEquals(3, $summary->count);
        $this->assertEquals(13046.27, round($summary->amount, 2));
        $this->assertNull($summary->group);
    }

    public function testSummarySimpleLimitedByDate() {
        $summaries = $this->service->summarySimple($this->date1, $this->date1);
        $this->assertNotNull($summaries);
        $this->assertEquals(1, count($summaries));
        $summary = $summaries[0];
        $this->assertTrue($summary instanceof SummaryBean);
        $this->assertEquals(2, $summary->count);
        $this->assertEquals(12546.17, round($summary->amount, 2));
        $this->assertNull($summary->group);
    }

    public function testSummaryByMonthAll() {
        $summaries = $this->service->summaryByMonth($this->date1, $this->date2);
        $this->assertNotNull($summaries);
        $this->assertEquals(2, count($summaries), 'count($summaries)');
        foreach($summaries as $summary) {
            $this->assertTrue($summary instanceof SummaryBean);
            if ($summary->group == '2010-01') {
                $this->assertEquals(2, $summary->count);
                $this->assertEquals(12546.17, round($summary->amount, 2));
            } elseif ($summary->group == '2010-02') {
                $this->assertEquals(1, $summary->count);
                $this->assertEquals(500.10, round($summary->amount, 2));
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
        $this->assertEquals(12546.17, round($summary->amount, 2));
    }

}