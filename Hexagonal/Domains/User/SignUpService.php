<?php
namespace Domains\User;
use Ports\User\UserRepositoryPort;
use Domains\Exception\UserEmailAlreadyExistException;

class SignUpService
{
    public function __construct(
        private readonly UserRepositoryPort $userRepositoryPort
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
        if ($this->userRepositoryPort->isEmailExist($email)) {
            throw new UserEmailAlreadyExistException();
        }
        $this->userRepositoryPort->create($email, $password, $name, $phone, $source);
    }
}