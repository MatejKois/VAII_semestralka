<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Message;
use App\Models\User;

class MessagesController extends AControllerBase
{
    public function authorize(string $action)
    {
        switch ($action) {
            case "store":
                return $this->app->getAuth()->isLogged();
            case "delete":
                $messageToDelete = Message::getOne($this->request()->getValue('id'));
                if ($messageToDelete) {
                    if ($this->app->getAuth()->isLogged()
                        && $messageToDelete->getUsersIdFrom() == $this->app->getAuth()->getLoggedUserId()) {
                        return true;
                    }
                }
                return false;
            case "chat":
                $uidFrom = $this->request()->getValue('uid_from');
                return $uidFrom == $this->app->getAuth()->isLogged() ?: $this->app->getAuth()->getLoggedUserName();
            case "showMessageAsRead":
                return false;
        }
        return true;
    }

    public function index(): Response
    {
        return $this->html();
    }

    public function store()
    {
        $userIdFrom = $this->app->getAuth()->getLoggedUserId();
        $userIdTo = $this->request()->getValue('uid_to');
        $text = $this->request()->getValue('text');
        $date = date('Y-m-d H:i:s');

        $id = $this->request()->getValue('id');
        if ($id != null) {
            $messageToStore = Message::getOne($id);
        } else {
            $messageToStore = new Message();
        }

        if (!$userIdFrom || !$userIdTo) {
            return $this->redirect("?c=advertisements");
        }

        $messageToStore->setUsersIdFrom($userIdFrom);
        $messageToStore->setUsersIdTo($userIdTo);
        if ($id != null) {
            $messageToStore->setText("(Upravené) " . $text);
        } else {
            $messageToStore->setText($text);
        }
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
        $idToEdit = $this->request()->getValue('edit_id');

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

        if ($idToEdit != null) {
            $args->setMessageToEditID($idToEdit);
        } else {
            $args->setMessageToEditID(-1);
        }

        return $this->html($args, viewName: 'chat');
    }

    public static function showMessageAsRead($id)
    {
        $message = Message::getOne($id);
        $message->setRead(1);
        $message->save();
    }
}

class ChatArguments
{
    private $uidTo;
    private $filteredMessages;
    private $messageToEditID;

    /**
     * @return mixed
     */
    public function getMessageToEditID()
    {
        return $this->messageToEditID;
    }

    /**
     * @param mixed $messageToEditID
     */
    public function setMessageToEditID($messageToEditID): void
    {
        $this->messageToEditID = $messageToEditID;
    }

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
