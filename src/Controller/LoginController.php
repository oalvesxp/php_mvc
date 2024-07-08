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

        /** Atualizando o algoritimo de altenticação */
        if (password_needs_rehash($userData['USR_PASSWD'], PASSWORD_ARGON2ID)){
            $qry = "UPDATE USR010 SET USR_PASSWD = ? WHERE USR_ID = ?";
            $stmt = $this->pdo->prepare($qry);
            $stmt->bindValue(1, password_hash($passwd, PASSWORD_ARGON2ID));
            $stmt->bindValue(2, $userData['USR_ID']);
            $stmt->execute();
        }

        if ($passwdAuth) {
            $_SESSION['login'] = true;
            header('Location: /');
            
        } else {
            header('Location: /login?success=0');
        }
    }
}
