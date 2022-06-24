<?php

use App\Application\Service\GetArticlesService;
use App\Controller\HomeController;
use App\Controller\Transformer\ArticleTransformer;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

return [
    Environment::class => function ($container): Environment {
        $dirpath = realpath(__DIR__.'/../public/views/');
        $loader = new FilesystemLoader($dirpath);

        return new Environment($loader);
    },

    EntityManagerInterface::class => function ($container): EntityManagerInterface {
        $dbConnectionPath = realpath(__DIR__.'/database.php');
        $conn = include $dbConnectionPath;
        $paths = [$conn['entities_path']];
        $config = ORMSetup::createAnnotationMetadataConfiguration($paths, true);

        return EntityManager::create($conn['connection'], $config);
    },

    GetArticlesService::class => function ($container): GetArticlesService {
        $entityManager = $container->get(EntityManagerInterface::class);

        return new GetArticlesService($entityManager);
    },

    ArticleTransformer::class => function ($container): ArticleTransformer {
        return new ArticleTransformer();
    },

    HomeController::class => function ($container): HomeController {
        $service = $container->get(GetArticlesService::class);
        $articleTransformer = $container->get(ArticleTransformer::class);

        return new HomeController($container->get(Environment::class), $service, $articleTransformer);
    }
];