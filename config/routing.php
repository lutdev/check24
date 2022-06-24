<?php
declare(strict_types=1);

use App\Configuration\Routing\Route;
use App\Controller\HomeController;

$route = new Route();
$route->get('/', HomeController::class, 'index');

return [
    'GET' => $route->getRoutesForGetMethod(),
    'POST' => $route->getRoutesForPostMethod(),
];