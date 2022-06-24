<?php
declare(strict_types=1);

namespace App\Configuration\Routing;

use App\Configuration\Routing\Exceptions\RequestMethodIsNotValidException;
use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;

/**
 * Base class for handling routes
 */
class Route
{
    /**
     * @throws RequestMethodIsNotValidException
     * @throws DependencyException
     * @throws NotFoundException
     */
    public static function get(string $path, string $controllerName, string $action)
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if ($requestMethod !== 'GET') {
            throw new RequestMethodIsNotValidException($requestMethod);
        }

        $builder = new ContainerBuilder();
        $defPath = realpath(__DIR__.'/../../../config/di.php');
        $builder->addDefinitions($defPath);
        $container = $builder->build();

        $controller = $container->get($controllerName);

        echo $controller->{$action}();
    }
}