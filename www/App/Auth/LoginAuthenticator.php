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
                $_SESSION['user_id'] = $user->getId();
                return true;
            }
        }
        return false;
    }

    function logout() : void
    {
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            unset($_SESSION["user_id"]);
            session_destroy();
        }
    }

    function isLogged(): bool
    {
        return isset($_SESSION['user']) && $_SESSION['user'] != null && isset($_SESSION['user_id']) && $_SESSION['user_id'] != null;
    }

    public function getLoggedUserId(): mixed
    {
//        return \App\Models\User::getIdByLogin($this->getLoggedUserName());
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : throw new \Exception("User not logged in");
    }
}
