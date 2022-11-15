<?php

namespace App\Controllers;

use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\User;

class UsersController extends AControllerBase
{
    public function index(): Response
    {
        return $this->html();
    }

    public function signup()
    {
        return $this->html(viewName: 'signup');
    }

    public function store()
    {
        $login = $this->request()->getValue('login');
        $password = $this->request()->getValue('password');

        foreach (User::getAll() as $user) {
            if ($user->getLogin() == $login) {
                return $this->html(['message' => 'Login už existuje!'], viewName: 'signup');
            }
        }

        if (strlen($login) > 2 && strlen($password) > 2) {
            $newUser = new User();
            $newUser->setLogin($login);
            $newUser->setPassword($password);
            $newUser->save();
        }
        return $this->redirect(Configuration::LOGIN_URL);
    }
}
