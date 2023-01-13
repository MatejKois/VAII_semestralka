<?php

namespace App\Models;

use App\Core\Model;

class Message extends Model
{
    protected $id;
    protected $users_id_from;
    protected $users_id_to;
    protected $text;
    protected $date;

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
    public function getUsersIdFrom()
    {
        return $this->users_id_from;
    }

    /**
     * @param mixed $users_id_from
     */
    public function setUsersIdFrom($users_id_from): void
    {
        $this->users_id_from = $users_id_from;
    }

    /**
     * @return mixed
     */
    public function getUsersIdTo()
    {
        return $this->users_id_to;
    }

    /**
     * @param mixed $users_id_to
     */
    public function setUsersIdTo($users_id_to): void
    {
        $this->users_id_to = $users_id_to;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }
}