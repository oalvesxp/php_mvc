<?php

namespace Alura\Mvc\Controller;

class LoginFormController implements Controller
{
    public function processRequest(): void
    {
        /** Verboso */
        // if(!array_key_exists('login', $_SESSION) && _SESSION['login'] === true) {
        
        /** Não verboso */
        if(($_SESSION['login'] ?? false) === true) {
            header('Location: /');
            return;
        }
        require_once __DIR__ . '/../../views/login-form.php';
    }
}
