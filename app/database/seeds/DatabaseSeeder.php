<?php

/*
 * Seed data for unitest.
 */

class DatabaseSeeder extends Seeder
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
        $this->call('ExpensesTableSeeder');
        $this->call('IncomesTableSeeder');
    }
}

class EmptySeeder extends Seeder
{
    public function run() {
        DB::table('incomes')->delete();
        DB::table('expenses')->delete();
        DB::table('categories')->delete();
        DB::table('users')->delete();
    }
}

class UsersTableSeeder extends Seeder
{
    public function run() {
        $user = new User();
        $user->username = 'admin';
        $user->password = Hash::make('admin123');
        $user->is_admin = true;
        $user->is_reporter = true;
        saveModel($user);

        $user = new User();
        $user->username = 'reporter';
        $user->password = Hash::make('reporter123');
        $user->is_admin = false;
        $user->is_reporter = true;
        saveModel($user);

        $user = new User();
        $user->username = 'viewer';
        $user->password = Hash::make('viewer123');
        $user->is_admin = false;
        $user->is_reporter = false;
        saveModel($user);
    }
}

class CategoriesTableSeeder extends Seeder
{
    public function run() {
        $cat = new Category();
        $cat->category_id = 'fd';
        $cat->name = 'Food';
        $cat->name_short = 'Food';
        $cat->order_pos = 1;
        $cat->descr = 'It\'s about eating';
        saveModel($cat);

        $cat = new Category();
        $cat->category_id = 'hh';
        $cat->name = 'Houshold';
        $cat->name_short = 'Houshold';
        $cat->order_pos = 2;
        $cat->descr = 'Houshold related expenses';
        saveModel($cat);

        $cat = new Category();
        $cat->category_id = 'el';
        $cat->name = 'Electronics';
        $cat->name_short = 'Electr';
        $cat->order_pos = 3;
        $cat->descr = 'TV, computers, cameras';
        saveModel($cat);
    }
}

class ExpensesTableSeeder extends Seeder
{
    public function run() {
        $reporter_user_id = DB::table('users')->select('user_id')->where('username', 'reporter')->first()->user_id;

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

class IncomesTableSeeder extends Seeder
{
    public function run() {
        $reporter_user_id = DB::table('users')->select('user_id')->where('username', 'reporter')->first()->user_id;

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

function saveModel($model) {
    if (!$model->save() && $model->errors()) {
        print 'Errors: ' . $model->errors();
    }
}
