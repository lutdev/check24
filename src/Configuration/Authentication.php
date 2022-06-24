<?php
declare(strict_types=1);

namespace App\Configuration;

class Authentication
{
    private const USER_AUTH_KEY = 'check24_user_security';

    public static function isUserAuth(): bool
    {
        return isset($_SESSION[self::USER_AUTH_KEY]);
    }
}