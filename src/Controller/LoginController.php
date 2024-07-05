<?php

namespace Alura\Mvc\Controller;

class LoginController implements Controller
{
    private \PDO $pdo;

    public function __construct()
    {
        $path = __DIR__ . '/../../database.sqlite';
        $this->pdo = new \PDO("sqlite:$path");
    }

    public function processRequest(): void
    {
        /** Buscar usuários no banco usando e-mail */
        $email = filter_input(INPUT_POST, 'user', FILTER_VALIDATE_EMAIL);
        $passwd= filter_input(INPUT_POST, 'password');

        $qry = "SELECT * FROM USR010 WHERE USR_EMAIL = ?";
        $stmt = $this->pdo->prepare($qry);
        $stmt->bindValue(1, $email);

        $stmt->execute();

        $userData = $stmt->fetch(\PDO::FETCH_ASSOC);
        $passwdAuth = password_verify($passwd, $userData['USR_PASSWD'] ?? '');

        if ($passwdAuth) {
            session_start();
            $_SESSION['login'] = true;
            
            header('Location: /');
            
        } else {
            header('Location: /login?success=0');
        }
    }
}
