<?php
declare(strict_types=1);

namespace App\Configuration;

use App\Domain\Entity\User;

class Authentication
{
    private const USER_AUTH_KEY = 'check24_user_security';

    public static function isUserAuth(): bool
    {
        return isset($_COOKIE[self::USER_AUTH_KEY]);
    }

    public static function authenticateUser(User $user): void
    {
        setcookie(self::USER_AUTH_KEY, \sprintf('check24_%d', $user->getId()), time() + 60*60*24*30, '/');
    }
}