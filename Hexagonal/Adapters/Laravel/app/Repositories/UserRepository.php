<?php

namespace LaravelApp\Repositories;

use Ports\User\UserRepositoryPort;
use Domains\Util\PaginatorInterface;
use LaravelApp\Models\User;

class UserRepository implements UserRepositoryPort
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

    public function paginate(int $page = 1, $pageSize = 10): PaginatorInterface
    {
        $paginator = User::paginate($pageSize, ['*'], 'page', $page);
        return new LaravelPaginator($paginator);
    }
}
