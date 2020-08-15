<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getUserById($user_id);
    public function authenticate($user, $request);
    public function checkAuthentication($request);
}
