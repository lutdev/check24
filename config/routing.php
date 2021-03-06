<?php
declare(strict_types=1);

use App\Configuration\Routing\Route;
use App\Controller\HomeController;
use App\Controller\LoginController;

$route = new Route();
$route->get('/', HomeController::class, 'index');
$route->get('/login', LoginController::class, 'showLoginPage');
$route->post('/login/post', LoginController::class, 'loginUser');

return [
    'GET' => $route->getRoutesForGetMethod(),
    'POST' => $route->getRoutesForPostMethod(),
];