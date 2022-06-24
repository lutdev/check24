<?php
declare(strict_types=1);

use App\Configuration\Routing\Route;
use App\Controller\HomeController;

Route::get('/', HomeController::class, 'index');