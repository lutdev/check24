<?php
declare(strict_types=1);

namespace App\Application\Infrastructure;

use App\Application\Repository\ArticleRepositoryInterface;
use Doctrine\ORM\EntityRepository;

final class ArticleRepository extends EntityRepository implements ArticleRepositoryInterface
{
    public function getAll(): array
    {
        return $this->findAll();
    }
}