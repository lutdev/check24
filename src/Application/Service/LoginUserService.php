<?php
declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Exception\EntityNotFoundException;
use App\Application\Repository\UserRepositoryInterface;
use App\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class LoginUserService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private HashPasswordService $hashPasswordService,
    ) {
    }

    /**
     * @throws EntityNotFoundException
     */
    public function process(string $userName, string $userPassword): User
    {
        /** @var UserRepositoryInterface $repository */
        $userRepository = $this->entityManager->getRepository(User::class);
        $hashedPassword = $this->hashPasswordService->hashPassword($userPassword);

        return $userRepository->findOneByLoginAndPassword($userName, $hashedPassword);
    }
}