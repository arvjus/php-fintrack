<?php namespace Fintrack\Storage;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider
{
    public function register() {
        $this->app->bind(
            'Fintrack\Storage\Services\LoginService',
            'Fintrack\Storage\Services\CategoryService',
            'Fintrack\Storage\Services\ExpenseService',
            'Fintrack\Storage\Services\IncomeService',
            'Fintrack\Storage\Services\DataAggregationService'
        );
    }

}