<?php

namespace App\Auth;


use App\Models\User;

class LoginAuthenticator extends DummyAuthenticator
{
    public function login($login, $password): bool
    {
        foreach (User::getAll() as $user) {
            if ($user->getLogin() == $login && $user->getPassword() == md5($password)) {
                $_SESSION['user'] = $login;
                return true;
            }
        }
        return false;
    }
}
