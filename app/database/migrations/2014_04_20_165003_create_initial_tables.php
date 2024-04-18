<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('username', 16)->unique();
            $table->string('password', 64);
            $table->string('remember_token', 64)->default('');
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_reporter')->default(false);
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->string('category_id', 2);
            $table->string('name', 20);
            $table->string('name_short', 15);
            $table->integer('order_pos')->default(0);
            $table->string('descr');

            $table->primary('category_id');
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('expense_id');
            $table->string('category_id', 2);
            $table->integer('user_id')->unsigned();
            $table->date('create_date');
            $table->float('amount');
            $table->string('descr')->nullable();

            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->foreign('user_id')->references('user_id')->on('users');
        });

        Schema::create('incomes', function (Blueprint $table) {
            $table->increments('income_id');
            $table->integer('user_id')->unsigned();
            $table->date('create_date');
            $table->float('amount');
            $table->string('descr')->nullable();

            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('incomes', function (Blueprint $table) {
            Schema::drop('incomes');
        });

        Schema::table('expenses', function (Blueprint $table) {
            Schema::drop('expenses');
        });

        Schema::table('categories', function (Blueprint $table) {
            Schema::drop('categories');
        });

        Schema::table('users', function (Blueprint $table) {
            Schema::drop('users');
        });
    }
}
