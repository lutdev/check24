<?php

use App\Application\Service\GetArticlesService;
use App\Application\Service\HashPasswordService;
use App\Application\Service\LoginUserService;
use App\Configuration\Request;
use App\Controller\HomeController;
use App\Controller\Transformer\ArticleTransformer;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

return [
    Environment::class => static function ($container): Environment {
        $dirpath = realpath(__DIR__.'/../public/views/');
        $loader = new FilesystemLoader($dirpath);

        return new Environment($loader);
    },

    EntityManagerInterface::class => static function ($container): EntityManagerInterface {
        $dbConnectionPath = realpath(__DIR__.'/database.php');
        $conn = include $dbConnectionPath;
        $paths = [$conn['entities_path']];
        $config = ORMSetup::createAnnotationMetadataConfiguration($paths, true);

        return EntityManager::create($conn['connection'], $config);
    },

    Request::class => static function ($container): Request {
        return new Request();
    },

    GetArticlesService::class => static function ($container): GetArticlesService {
        $entityManager = $container->get(EntityManagerInterface::class);

        return new GetArticlesService($entityManager);
    },

    HashPasswordService::class => static function ($container): HashPasswordService {
        return new HashPasswordService();
    },

    LoginUserService::class => static function ($container): LoginUserService {
        $entityManager = $container->get(EntityManagerInterface::class);
        $hashPasswordService = $container->get(HashPasswordService::class);

        return new LoginUserService($entityManager, $hashPasswordService);
    },

    ArticleTransformer::class => static function ($container): ArticleTransformer {
        return new ArticleTransformer();
    },

    HomeController::class => static function ($container): HomeController {
        $service = $container->get(GetArticlesService::class);
        $articleTransformer = $container->get(ArticleTransformer::class);

        return new HomeController(
            $container->get(Request::class),
            $container->get(Environment::class),
            $service,
            $articleTransformer
        );
    }
];