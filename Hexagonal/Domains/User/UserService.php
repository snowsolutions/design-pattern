<?php
namespace Domains\User;

use Adapters\User\UserRepositoryAdapter;
use Domains\Util\PaginatorInterface;

class UserService
{
  public function __construct(
    private readonly UserRepositoryAdapter $userRepositoryAdapter
  )
  {
  }

  public function paginate(int $page = 1, $pageSize = 10): PaginatorInterface
  {
      return $this->userRepositoryAdapter->paginate($page, $pageSize);
  }
}