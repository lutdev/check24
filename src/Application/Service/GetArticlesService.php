<?php
declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Repository\ArticleRepositoryInterface;
use App\Domain\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class GetArticlesService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    )
    {
    }

    public function process(): array
    {
        /** @var ArticleRepositoryInterface $repository */
        $repository = $this->entityManager->getRepository(Article::class);

        return $repository->getAll();
    }
}