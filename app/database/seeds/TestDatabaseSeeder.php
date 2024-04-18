<?php

/*
 * Seed data for unitest.
 */

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();

        $this->call('EmptySeeder');
        $this->call('UsersTableSeeder');
        $this->call('CategoriesTableSeeder');
        $this->call('TestExpensesTableSeeder');
        $this->call('TestIncomesTableSeeder');
    }
}

class TestExpensesTableSeeder extends Seeder
{
    public function run() {
        $reporter_user_id = DB::table('users')->select('user_id')->where('username', 'reporter')->first()->user_id;

        for ($i = 0; $i < 100; $i++) {
            $expense = new Expense();
            $expense->category_id = 'fd';
            $expense->user_id = $reporter_user_id;
            $expense->create_date = date('Y-m-d', strtotime('2010-01-01'));
            $expense->amount = 55.75;
            $expense->descr = 'McDonald\'s';
            saveModel($expense);

            $expense = new Expense();
            $expense->category_id = 'fd';
            $expense->user_id = $reporter_user_id;
            $expense->create_date = date('Y-m-d', strtotime('2010-02-01'));
            $expense->amount = 123.45;
            $expense->descr = 'Sausages';
            saveModel($expense);

            $expense = new Expense();
            $expense->category_id = 'el';
            $expense->user_id = $reporter_user_id;
            $expense->create_date = date('Y-m-d', strtotime('2010-01-01'));
            $expense->amount = 4500;
            $expense->descr = 'new iPhone';
            saveModel($expense);

            $expense = new Expense();
            $expense->category_id = 'hh';
            $expense->user_id = $reporter_user_id;
            $expense->create_date = date('Y-m-d', strtotime('2010-02-10'));
            $expense->amount = 100.0;
            $expense->descr = 'toapapper';
            saveModel($expense);
        }
    }
}

class TestIncomesTableSeeder extends Seeder
{
    public function run() {
        $reporter_user_id = DB::table('users')->select('user_id')->where('username', 'reporter')->first()->user_id;

        for ($i = 0; $i < 50; $i++) {
            $income = new Income();
            $income->user_id = $reporter_user_id;
            $income->create_date = date('Y-m-d', strtotime('2010-01-01'));
            $income->amount = 12345.67;
            $income->descr = 'Salary';
            saveModel($income);

            $income = new Income();
            $income->user_id = $reporter_user_id;
            $income->create_date = date('Y-m-d', strtotime('2010-01-01'));
            $income->amount = 200.50;
            $income->descr = 'Books on eBay';
            saveModel($income);

            $income = new Income();
            $income->user_id = $reporter_user_id;
            $income->create_date = date('Y-m-d', strtotime('2010-02-10'));
            $income->amount = 500.10;
            $income->descr = 'Extra jobb';
            saveModel($income);
        }
    }
}
