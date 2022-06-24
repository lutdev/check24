<?php
declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Entity\Article;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

class GetArticlesService
{
    public function process(): array
    {
        $conn = [
            'driver'   => 'pdo_mysql',
            'host' => '127.0.0.1',
            'user'     => 'check24',
            'password' => '123456',
            'dbname'   => 'check24',
        ];
        $entities = realpath(__DIR__.'/../../Domain/Entity');
        $paths = [$entities];
        $isDevMode = true;
        $config = ORMSetup::createAnnotationMetadataConfiguration($paths, true);
        $entityManager = EntityManager::create($conn, $config);
        $repository = $entityManager->getRepository(Article::class);
        return $repository->getAll();
    }
}