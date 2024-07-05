<?php

namespace Alura\Mvc\Controller;

class LoginFormController implements Controller
{
    public function processRequest(): void
    {
        if($_SESSION['login'] === true) {
            header('Location: /');
            return;
        }
        require_once __DIR__ . '/../../views/login-form.php';
    }
}
