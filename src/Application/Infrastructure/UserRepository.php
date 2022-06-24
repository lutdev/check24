<?php
declare(strict_types=1);

namespace App\Application\Infrastructure;

use App\Application\Exception\EntityNotFoundException;
use App\Application\Repository\UserRepositoryInterface;
use App\Domain\Entity\User;
use Doctrine\ORM\EntityRepository;

final class UserRepository extends EntityRepository implements UserRepositoryInterface
{
    public function findOneByLoginAndPassword(string $login, string $password): User
    {
        $user = $this->findOneBy([
            'login' => $login,
            'password' => $password
        ]);

        if ($user === null) {
            throw new EntityNotFoundException('Users not found');
        }

        return $user;
    }
}