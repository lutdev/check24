<?php
declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Application\Infrastructure\UserRepository")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $password;

    public function getId(): int
    {
        return $this->id;
    }
}