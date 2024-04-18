<?php namespace Fintrack\Storage\Services;

use User;

class UserService
{
    public function all() {
        return User::all();
    }

    public function allAsArray() {
        $array = array();
        foreach (User::all() as $user) {
            $array[$user->user_id] = $user->username;
        }
        return $array;
    }

    public function find($user_id) {
        return User::find($user_id);
    }

    public function findByName($name) {
        return User::where('username', $name)->first();
    }
}
