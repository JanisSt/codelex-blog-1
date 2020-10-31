<?php

namespace App\Controllers;

use Respect\Validation\Validator;
use App\Models\User;

class RegisterController
{
    public function __construct()
    {
        if (isset($_SESSION['auth_id']))
        {
            header('Location: /');
        }
    }

    public function showRegistrationForm()
    {
        return require_once __DIR__  . '/../Views/RegisterView.php';
    }

    public function register()
    {
        // $_POST => name, email, password, password_confirmation
        $validEmail = Validator::email()->validate($_POST['email']);
        $validName = $_POST['name'] !== '';
        $validPassword = $_POST['password'] !== '' && $_POST['password_confirmation'] === $_POST['password'];
        $validRef = $_POST['reff'] !== '';

        if ($validEmail && $validName && $validPassword)
        {
//            if($validRef = false) {
//                $ref = query()->select('id')
//                    ->from('users')
//                    ->where('reff = ?')
//                    ->setParameter(0, User::() )
//                    ->execute()
//                    ->fetchAssociative();
//
//
//
//            }
                $user = User::create($_POST);

                $query = query();
                $query->insert('users')
                    ->values([
                        'name' => ':name',
                        'email' => ':email',
                        'password' => ':password',
                        'reff' => ':reff',
                    ])
                    ->setParameters($user->toArray())
                    ->execute();



            $_SESSION['auth_id'] = (int) $query->getConnection()->lastInsertId();

            return header('Location: /');
        }

        return header('Location: /register');
    }
}