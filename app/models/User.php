<?php

use LaravelBook\Ardent\Ardent;
use Illuminate\Auth\UserInterface;

class User extends Ardent implements UserInterface
{
    public $timestamps = false;
    protected $primaryKey = 'user_id';
    protected $guarded = array('user_id', 'password', 'is_admin', 'is_reporter');

    /**
     * Ardent validation rules
     */
    public static $rules = array(
        'username' => 'required|between:4,16',
        'password' => 'required|between:4,64',
    );

    public function getAuthIdentifier() {
        return $this->getKey();
    }

    public function getAuthPassword() {
        return $this->password;
    }

    public function getRememberToken() {
        return $this->remember_token;
    }

    public function setRememberToken($value) {
        $this->remember_token = $value;
    }

    public function getRememberTokenName() {
        return 'remember_token';
    }
}
