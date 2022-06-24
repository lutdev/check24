<?php
declare(strict_types=1);

namespace App\Controller;

class LoginController extends Controller
{
    public function showLoginPage(): string
    {
        return $this->view('login');
    }
}