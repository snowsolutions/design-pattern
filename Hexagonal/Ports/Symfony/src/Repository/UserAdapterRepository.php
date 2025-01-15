<?php
namespace SymfonyApp\Repository;
use Adapters\User\UserRepositoryAdapter;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use SymfonyApp\Entity\User;
class UserAdapterRepository implements UserRepositoryAdapter
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {

    }

    /**
     * @return EntityRepository|UserRepository
     */
    private function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository(User::class);
    }

    public function isEmailExist(string $email): bool
    {
        return $this->getRepository()->isEmailExist($email);
    }

    public function create(string $email, string $password, string $name, string $phone, string $source)
    {
        $this->getRepository()->create($email, $password, $name, $phone, $source);
    }
}