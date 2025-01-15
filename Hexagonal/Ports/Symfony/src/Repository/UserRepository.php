<?php
namespace SymfonyApp\Repository;
use Adapters\User\UserRepositoryAdapter;
use Doctrine\ORM\EntityRepository;
use SymfonyApp\Entity\User;
class UserRepository extends EntityRepository implements UserRepositoryAdapter
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
}