<?php
declare(strict_types=1);

namespace App\Controller;

use App\Application\Exception\EntityNotFoundException;
use App\Application\Service\LoginUserService;
use App\Configuration\Authentication;
use App\Configuration\Request;
use Twig\Environment;

class LoginController extends Controller
{
    public function __construct(
        public Request $request,
        private Environment $twig,
        private LoginUserService $loginUserService
    ) {
        parent::__construct($this->request, $this->twig);
    }

    public function showLoginPage(): string
    {
        return $this->view('login');
    }

    public function loginUser(): string
    {
        /** @var array{login?: string, password?: string} $params */
        $params = $this->request->fetchParams(['login', 'password'], Request::METHOD_POST);

        if (empty($params['login']) || empty($params['password'])) {
            return $this->view('login', [
                'error' => 'You need fill all fields'
            ]);
        }

        $userName = trim(strip_tags($params['login']));

        try {
            $user = $this->loginUserService->process($userName, $params['password']);
        } catch (EntityNotFoundException) {
            return $this->view('login', [
                'error' => 'Try again!'
            ]);
        }

        Authentication::authenticateUser($user);

        header('Location: /', response_code: 301);
    }
}