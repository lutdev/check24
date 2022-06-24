<?php
declare(strict_types=1);

namespace App\Application\Repository;

use App\Application\Exception\EntityNotFoundException;
use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @throws EntityNotFoundException
     */
    public function findOneByLoginAndPassword(string $login, string $password): User;
}