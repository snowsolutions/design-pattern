<?php
namespace Domains\User;

use Ports\User\UserRepositoryPort;
use Domains\Util\PaginatorInterface;

class UserService
{
  public function __construct(
    private readonly UserRepositoryPort $userRepositoryPort
  )
  {
  }

  public function paginate(int $page = 1, $pageSize = 10): PaginatorInterface
  {
      return $this->userRepositoryPort->paginate($page, $pageSize);
  }
}