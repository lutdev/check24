<?php
declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="articles")
 * @ORM\Entity(repositoryClass="App\Application\Infrastructure\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;

    public function getId(): int
    {
        return $this->id;
    }
}