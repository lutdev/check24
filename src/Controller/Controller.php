<?php
declare(strict_types=1);

namespace App\Controller;

use Twig\Environment;

class Controller
{
    public function __construct(
        private Environment $twig
    ) {
    }

    public function view(string $templatePath, array $params): string
    {
        return $this->twig->render($templatePath.'.html', $params);
    }
}