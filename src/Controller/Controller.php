<?php
declare(strict_types=1);

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Twig\Environment;

class Controller
{
    private Environment $twig;
    private EntityManagerInterface $entityManager;

    public function view(string $templatePath, array $params): string
    {
        return $this->twig->render($templatePath.'.html', $params);
    }

    public function setTwig(Environment $twig): void
    {
        $this->twig = $twig;
    }

    public function setEntityManager(EntityManagerInterface $entityManager): void
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }
}