<?php
/** @var \App\Models\Message[] $filteredMessages */
/** @var \App\Core\IAuthenticator $auth */
?>

<div class="overflow-auto">
    <?php foreach ($filteredMessages as $message) {
        $loggedID = \App\Models\User::getIdByLogin($auth->getLoggedUserName());
        if ($message->getUsersIdFrom() != $loggedID && $message->getUsersIdTo() != $loggedID) {
            ?><p style="color: red">Tieto správy nepatria Vám!!!</p> <?php
            break;
        }
        ?>
        <div
            <?php if ($message->getUsersIdFrom() == $auth->getLoggedUserName()) { ?>
                style="color: blue"
            <?php } ?>
        >
            [<?php echo $message->getDate() ?>
            ] <?php echo \App\Models\User::getOne($message->getUsersIdFrom())->getLogin() ?>
            : <?php echo $message->getText(); ?>
        </div><br> <?php
    } ?>
</div>

<form method="post" action="?c=messages&a=store">
    <div class="mb-3">
        <label class="form-label">Text správy</label>
        <textarea class="form-control" name="text" rows="3">

        </textarea>
    </div>
    <input type="submit" class="btn btn-primary mb-3" value="Odoslať">
</form>






<!--<div class="overflow-hidden">-->
<!--    asdfasdfasdff-->
<!--</div>-->
