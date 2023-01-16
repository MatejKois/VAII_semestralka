<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected $id;
    protected $login;
    protected $password;

//    static public function getIdByLogin($pLogin) : int
//    {
//        $users = self::getAll();
//        foreach ($users as $user) {
//            if ($user->getLogin() == $pLogin) {
//                return $user->id;
//            }
//        }
//        return -1;
//    }

    static public function getLoginById($pID) : string
    {
        $user = self::getOne($pID);
        if ($user) {
            return $user->getLogin();
        }
        return "-1";
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }
}
