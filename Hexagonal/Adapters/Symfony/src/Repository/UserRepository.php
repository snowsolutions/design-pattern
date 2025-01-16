<?php
namespace SymfonyApp\Repository;
use Ports\User\UserRepositoryPort;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Domains\Util\PaginatorInterface;
use SymfonyApp\Entity\User;
use SymfonyApp\SymfonyPaginator;

class UserRepository extends EntityRepository implements UserRepositoryPort
{
    public function isEmailExist(string $email): bool
    {
        $user = $this->findOneBy([
            'email' => $email,
        ]);
        return !empty($user);
    }

    public function create(string $email, string $password, string $name, string $phone, string $source)
    {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword(hash('sha256', $password));
        $user->setName($name);
        $user->setPhone($phone);
        $user->setSource($source);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function paginate(int $page = 1, $pageSize = 10): PaginatorInterface
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->select('c')
            ->orderBy('c.id', 'ASC')
            ->setFirstResult(($page - 1) * $pageSize)
            ->setMaxResults($pageSize);
        $paginator = new Paginator($queryBuilder);
        return new SymfonyPaginator($paginator);
    }
}