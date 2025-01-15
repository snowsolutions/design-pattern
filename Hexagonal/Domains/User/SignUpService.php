<?php
namespace Domains\User;
use Adapters\User\UserRepositoryAdapter;
use Domains\Exception\UserEmailAlreadyExistException;

class SignUpService
{
    public function __construct(
        private readonly UserRepositoryAdapter $userRepositoryAdapter
    )
    {
    }

    /**
     * @throws UserEmailAlreadyExistException
     */
    public function execute(
        string $email,
        string $password,
        string $name,
        string $phone,
        string $source
    )
    {
        if ($this->userRepositoryAdapter->isEmailExist($email)) {
            throw new UserEmailAlreadyExistException();
        }
        $this->userRepositoryAdapter->create($email, $password, $name, $phone, $source);
    }
}