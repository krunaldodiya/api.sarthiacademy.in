<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getUserById($user_id);
    public function login($user, $request);
    public function register($request);
}
