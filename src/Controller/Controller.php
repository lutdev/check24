<?php
declare(strict_types=1);

namespace App\Controller;

use App\Configuration\Authentication;
use App\Configuration\Request;
use Twig\Environment;

class Controller
{
    public function __construct(
        public Request $request,
        private Environment $twig,
    ) {
    }

    public function view(string $templatePath, array $params = []): string
    {
        return $this->twig->render($templatePath.'.html', $params);
    }

    public function isUserLogged(): bool
    {
        return Authentication::isUserAuth();
    }
}