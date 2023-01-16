<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Message;

class ChatArguments
{
    private $uidTo;
    private $filteredMessages;

    /**
     * @return mixed
     */
    public function getUidTo()
    {
        return $this->uidTo;
    }

    /**
     * @param mixed $uidTo
     */
    public function setUidTo($uidTo): void
    {
        $this->uidTo = $uidTo;
    }

    /**
     * @return mixed
     */
    public function getFilteredMessages()
    {
        return $this->filteredMessages;
    }

    /**
     * @param mixed $filteredMessages
     */
    public function setFilteredMessages($filteredMessages): void
    {
        $this->filteredMessages = $filteredMessages;
    }
}

class MessagesController extends AControllerBase
{
    public function authorize(string $action)
    {
        // !!
        return true;
    }

    public function index(): Response
    {
        return $this->html();
    }

    public function store()
    {
        $messageToStore = new Message();
        $userIdFrom = $this->request()->getValue('uid_from');
        $userIdTo = $this->request()->getValue('uid_to');
        $text = $this->request()->getValue('text');
        $date = date('Y-m-d H:i:s');

        if (!$userIdFrom || !$userIdTo) {
            return $this->redirect("?c=advertisements");
        }

        $messageToStore->setUsersIdFrom($userIdFrom);
        $messageToStore->setUsersIdTo($userIdTo);
        $messageToStore->setText($text);
        $messageToStore->setDate($date);
        $messageToStore->setRead(0);

        ConversationsController::showNewMessage($userIdFrom, $userIdTo);

        $messageToStore->save();

        return $this->redirect("?c=messages&a=chat&uid_from=" . $userIdFrom . "&uid_to=" . $userIdTo);
    }

    public function delete()
    {
        $messageToDelete = Message::getOne($this->request()->getValue('id'));
        $userIdFrom = $this->request()->getValue('uid_from');
        $userIdTo = $this->request()->getValue('uid_to');

        if (!$messageToDelete || !$userIdFrom || !$userIdTo) {
            return $this->redirect("?c=advertisements");
        }

        $messageToDelete->delete();

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
            if (($message->getUsersIdFrom() == $uidFrom && $message->getUsersIdTo() == $uidTo)
                || ($message->getUsersIdFrom() == $uidTo && $message->getUsersIdTo() == $uidFrom)) {
                $filteredMessages[$pos] = $message;
                ++$pos;
            }
        }

        $args = new ChatArguments();
        $args->setUidTo($uidTo);
        $args->setFilteredMessages($filteredMessages);

        return $this->html($args, viewName: 'chat');
    }

    public static function showMessageAsRead($id)
    {
        $message = Message::getOne($id);
        $message->setRead(1);
        $message->save();
    }
}
