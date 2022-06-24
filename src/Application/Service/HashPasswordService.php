<?php
declare(strict_types=1);

namespace App\Application\Service;

class HashPasswordService
{
    public function hashPassword(string $password): string
    {
        return md5($password);
    }
}