<?php

namespace App\Controllers;

class LoginController
{
    public function __construct()
    {
        if (isset($_SESSION['auth_id']))
        {
            header('Location: /');
        }
    }

    public function showLoginForm()
    {
        return require_once __DIR__  . '/../Views/LoginView.php';
    }

    public function login()
    {
        $user = query()
            ->select('*')
            ->from('users')
            ->where('email = :email')
            ->setParameter('email', $_POST['email'])
            ->execute()
            ->fetchAssociative();

        if (! $user || ! password_verify($_POST['password'], $user['password'])) {
            // Show errors
            return header('Location: /login');
        }

        $_SESSION['auth_id'] = (int) $user['id'];

        return header('Location: /');
    }

    public function logout()
    {
        session_destroy();

        header('Location: /');
    }
}