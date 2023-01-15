<?php

namespace App\Models;

use App\Core\Model;

class Conversation extends Model
{
    protected $id;
    protected $users_id_1;
    protected $users_id_2;
    protected $hasNewMessage;

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
    public function getUsersId1()
    {
        return $this->users_id_1;
    }

    /**
     * @param mixed $users_id_1
     */
    public function setUsersId1($users_id_1): void
    {
        $this->users_id_1 = $users_id_1;
    }

    /**
     * @return mixed
     */
    public function getUsersId2()
    {
        return $this->users_id_2;
    }

    /**
     * @param mixed $users_id_2
     */
    public function setUsersId2($users_id_2): void
    {
        $this->users_id_2 = $users_id_2;
    }

    /**
     * @return mixed
     */
    public function getHasNewMessage()
    {
        return $this->hasNewMessage;
    }

    /**
     * @param mixed $hasNewMessage
     */
    public function setHasNewMessage($hasNewMessage): void
    {
        $this->hasNewMessage = $hasNewMessage;
    }
}
