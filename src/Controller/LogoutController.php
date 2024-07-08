<?php

namespace Alura\Mvc\Controller;

class LogoutController implements Controller
{
    public function processRequest(): void
    {
        // session_destroy();
        // $_SESSION['login'] = false;
        unset($_SESSION['login']);
        header('Location: /login');
    }
}
