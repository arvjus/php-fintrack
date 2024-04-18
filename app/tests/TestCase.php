<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * Default preparation for each test
     */
    public function setUp() {
        parent::setUp();

        // Migrate database
        $this->initDatabase();
        $this->seedTestData();
    }

    private function initDatabase() {
        Artisan::call('migrate');
    }

    private function seedTestData() {
        Artisan::call('db:seed');
        /*
        Artisan::call('db:seed',
            array('--class' => 'EmptySeeder',
                '--class' => 'RolesTableSeeder',
                '--class' => 'UsersTableSeeder',
                '--class' => 'UsersRolesTableSeeder'
            ));
        */
    }

    /**
     * Creates the application.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication() {
        $unitTesting = true;

        $testEnvironment = 'testing';

        return require __DIR__ . '/../../bootstrap/start.php';
    }
}
