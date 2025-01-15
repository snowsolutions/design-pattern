<?php

namespace LaravelApp\Repositories;

use Adapters\User\UserRepositoryAdapter;
use LaravelApp\Models\User;

class UserRepository implements UserRepositoryAdapter
{


    public function isEmailExist(string $email): bool
    {
        $user = User::firstWhere(['email' => $email]);
        return !empty($user);
    }
    public function create(
        string $email,
        string $password,
        string $name,
        string $phone,
        string $source
    )
    {
        User::insert([
            'email' => $email,
            'password' => hash('sha256', $password),
            'name' => $name,
            'phone' => $phone,
            'source' => $source
        ]);
    }
}
