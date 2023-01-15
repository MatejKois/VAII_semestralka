<?php
/** @var \App\Core\IAuthenticator $auth */
$conversations = \App\Models\Conversation::getAll();
?>

<div>
    <?php foreach ($conversations as $conversation) {
        if ($conversation->getUsersId1() == \App\Models\User::getIdByLogin($auth->getLoggedUserName())) { ?>
            <a href="?c=messages&a=chat&uid_from=<?php echo $conversation->getUsersId1() ?>&uid_to=<?php echo $conversation->getUsersId2() ?>">
                <?php echo \App\Models\User::getLoginById($conversation->getUsersId2()) ?>
            </a><br>
        <?php }
        if ($conversation->getUsersId2() == \App\Models\User::getIdByLogin($auth->getLoggedUserName())) { ?>
            <a href="?c=messages&a=chat&uid_from=<?php echo $conversation->getUsersId2() ?>&uid_to=<?php echo $conversation->getUsersId1() ?>">
                <?php echo \App\Models\User::getLoginById($conversation->getUsersId1()) ?>
            </a><br>
        <?php } ?>
    <?php } ?>
</div>
