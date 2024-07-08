<?php

namespace Alura\Mvc\Controller;

class LoginFormController extends ControllerHTML implements Controller
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
        
        echo $this->renderTemplate('login-form.php');
    }
}
