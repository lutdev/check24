<?php
declare(strict_types=1);

namespace App\Configuration\Routing;

use App\Configuration\Routing\Exceptions\RequestMethodIsNotValidException;
use App\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Base class for handling routes
 */
class Route
{
    /**
     * @throws RequestMethodIsNotValidException
     */
    public static function get(string $path, string $controller, string $action)
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if ($requestMethod !== 'GET') {
            throw new RequestMethodIsNotValidException($requestMethod);
        }

        $dirpath = realpath(__DIR__.'/../../../public/views/');
        $loader = new FilesystemLoader($dirpath);
        $twig = new Environment($loader);

        /** @var Controller $controller */
        $controller = new $controller;
        $controller->setTwig($twig);

        $dbConnectionPath = realpath(__DIR__.'/../../../config/database.php');
        $conn = include $dbConnectionPath;
        $paths = [$conn['entities_path']];
        $config = ORMSetup::createAnnotationMetadataConfiguration($paths, true);
        $entityManager = EntityManager::create($conn['connection'], $config);
        $controller->setEntityManager($entityManager);

        echo $controller->{$action}();
    }
}