<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Conversation;

class ConversationsController extends AControllerBase
{

    public function authorize(string $action)
    {
        return true;
    }

    public function index(): Response
    {
        return $this->html();
    }

    public function store()
    {
        $userIdFrom = $this->request()->getValue('uid_from');
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
}
