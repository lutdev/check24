<?php
declare(strict_types=1);

namespace App\Application\Repository;

interface ArticleRepositoryInterface
{
    public function getAll(): array;
}