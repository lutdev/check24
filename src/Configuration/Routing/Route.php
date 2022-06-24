<?php
declare(strict_types=1);

namespace App\Configuration\Routing;

use App\Configuration\Routing\Exceptions\RequestMethodIsNotValidException;

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

        return (new $controller)->{$action}();
    }
}