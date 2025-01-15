<?php
namespace Adapters\User;
use Domains\Util\PaginatorInterface;

interface UserRepositoryAdapter
{
    public function isEmailExist(string $email): bool;
    public function create(
        string $email,
        string $password,
        string $name,
        string $phone,
        string $source
    );

    public function paginate(int $page = 1, $pageSize = 10): PaginatorInterface;
}