<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Conversation;

class ConversationsController extends AControllerBase
{

    public function authorize(string $action)
    {
        switch ($action) {
            case "store":
                return $this->app->getAuth()->isLogged();
            case "showNewMessage":
            case "hideNewMessage":
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

        if (!$userIdFrom || !$userIdTo) {
            return $this->redirect("?c=advertisements");
        }

        $conversations = Conversation::getAll();
        foreach ($conversations as $conversation) {
            if (($conversation->getUsersId1() == $userIdFrom && $conversation->getUsersId2() == $userIdTo)
                || ($conversation->getUsersId2() == $userIdFrom && $conversation->getUsersId1() == $userIdTo)) {
                return $this->redirect("?c=messages&a=chat&uid_from=" . $userIdFrom . "&uid_to=" . $userIdTo);
            }
        }

        $conversation = new Conversation();
        $conversation->setUsersId1($userIdFrom);
        $conversation->setUsersId2($userIdTo);
        $conversation->setHasNewMessage(0);
        $conversation->save();

        return $this->redirect("?c=messages&a=chat&uid_from=" . $userIdFrom . "&uid_to=" . $userIdTo);
    }

    public static function showNewMessage($fromUserId, $toUserId)
    {
        $conversations = Conversation::getAll();
        foreach ($conversations as $conversation) {
            if (($conversation->getUsersId1() == $fromUserId && $conversation->getUsersId2() == $toUserId)
                || ($conversation->getUsersId1() == $toUserId && $conversation->getUsersId2() == $fromUserId)) {
                $conversation->setHasNewMessage($toUserId);
                $conversation->save();
                break;
            }
        }
    }

    public static function hideNewMessage($conversation)
    {
        $conversation->setHasNewMessage(0);
        $conversation->save();
    }
}
