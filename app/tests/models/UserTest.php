<?php

class UserTest extends TestCase {

    public function testCreateIncomplete() {
        $user = new User();
        $this->assertFalse($user->save());
    }

    public function testCreateOk() {
        $user = new User();
        $user->username = 'user';
        $user->password = 'password';
        $this->assertTrue($user->save());
    }

    public function testFindAll() {
        $users = User::all();
        $this->assertNotEmpty($users);
        $this->assertEquals(3, count($users));
    }
}
