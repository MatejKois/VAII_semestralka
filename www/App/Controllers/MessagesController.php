<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Message;

class MessagesController extends AControllerBase
{
    public function authorize(string $action)
    {
        switch ($action) {
            case "store":
                return true;
        }
        return false;
    }

    public function index(): Response
    {
        return $this->html(viewName: 'index');
    }

    public function store()
    {
        $messageToStore = new Message();
        $userIdFrom = $this->request()->getValue('uid_from');
        $userIdTo = $this->request()->getValue('uid_to');
        $text = $this->request()->getValue('text');
        $date = date('Y-m-d H:i:s');

        if (!$userIdFrom || $userIdTo) {
            return $this->redirect("?c=advertisements");
        }

        $messageToStore->setUsersIdFrom($userIdFrom);
        $messageToStore->setUsersIdTo($userIdTo);
        $messageToStore->setText($text);
        $messageToStore->setDate($date);

        $messageToStore->save();

        return $this->redirect("?c=messages&a=chat&uid_from=" . $userIdFrom . "&uid_to=" . $userIdTo);
    }

    public function chat()
    {
        $uidFrom = $this->request()->getValue('uid_from');
        $uidTo = $this->request()->getValue('uid_to');

        $allMessages = Message::getAll();
        $filteredMessages = array();
        $pos = 0;
        foreach ($allMessages as $message) {
            if ($message->getUsersIdFrom() == $uidFrom || $message->getUsersIdTo() == $uidFrom
                || $message->getUsersIdFrom() == $uidTo || $message->getUsersIdTo() == $uidTo) {
                $filteredMessages[$pos] = $message;
                ++$pos;
            }
        }
        return $this->html($filteredMessages, viewName: 'chat');
    }
}
