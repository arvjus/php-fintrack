<?php

use Fintrack\Storage\Services\UserService;

// name	is_admin	is_reporter
// admin	1	1
// reporter	0	1
// viewer	0	0

class UserServiceTest extends TestCase {
    public function setUp() {
        parent::setUp();

        $this->service = new UserService();
    }

    public function testGetAll() {
        $users = $this->service->all();
        $this->assertNotNull($users);
        $this->assertEquals(3, count($users));
    }

    public function testFind() {
        $user = $this->service->findByName('admin');
        $this->assertNotNull($user);
        $this->assertEquals('admin', $user->username);
        $user_id = $user->user_id;
        $user = $this->service->find($user_id);
        $this->assertNotNull($user);
        $this->assertEquals('admin', $user->username);
    }

    public function testRoles() {
        $user = $this->service->findByName('reporter');
        $this->assertNotNull($user);
        $this->assertEquals(1, $user->is_reporter, 'is_reporter');
        $this->assertEquals(0, $user->is_admin, 'is_admin');
    }
}