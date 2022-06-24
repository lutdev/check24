<?php
declare(strict_types=1);

namespace App\Controller;

class Controller
{
    public function view(string $templatePath): void
    {
        include __DIR__.'/../../public/views/'.$templatePath.'.php';
    }
}