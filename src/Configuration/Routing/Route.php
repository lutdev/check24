<?php
declare(strict_types=1);

namespace App\Configuration\Routing;

/**
 * Base class for handling routes
 */
class Route
{
    private array $routesGetMethod = [];
    private array $routesPostMethod = [];

    public function get(string $path, string $controllerName, string $action): void
    {
        $this->routesGetMethod[$path] = [$controllerName, $action];
    }

    public function post(string $path, string $controllerName, string $action): void
    {
        $this->routesPostMethod[$path] = [$controllerName, $action];
    }

    public function getRoutesForGetMethod(): array
    {
        return $this->routesGetMethod;
    }

    public function getRoutesForPostMethod(): array
    {
        return $this->routesPostMethod;
    }
}