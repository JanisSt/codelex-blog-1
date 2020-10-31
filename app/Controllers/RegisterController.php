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
        $referral = $_GET['r'] ?? null;

        $user = query()
            ->select('*')
            ->from('users')
            ->where('MD5(email) = :email')
            ->setParameter('email', $referral)
            ->execute()
            ->fetchAssociative();

        return require_once __DIR__  . '/../Views/RegisterView.php';
    }

    public function register()
    {
        $validEmail = Validator::email()->validate($_POST['email']);
        $validName = $_POST['name'] !== '';
        $validPassword = $_POST['password'] !== '' && $_POST['password_confirmation'] === $_POST['password'];

        if ($validEmail && $validName && $validPassword)
        {
            $referredBy = query()
                ->select('*')
                ->from('users')
                ->where('MD5(email) = :email')
                ->setParameter('email', $_GET['r'] ?? null)
                ->execute()
                ->fetchAssociative();

            $data = $_POST;

            if ($referredBy) {
                $data['referred_by'] = (int) $referredBy['id'];
            }

            $user = User::create($data);

            $query = query();
            $query->insert('users')
                ->values([
                    'name' => ':name',
                    'email' => ':email',
                    'password' => ':password',
                    'referred_by' => ':referred_by'
                ])
                ->setParameters($user->toArray())
                ->execute();

            $_SESSION['auth_id'] = (int) $query->getConnection()->lastInsertId();

            return header('Location: /');
        }

        return header('Location: /register');
    }
}