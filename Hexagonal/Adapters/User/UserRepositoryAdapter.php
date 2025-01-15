<?php
namespace Adapters\User;
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
}