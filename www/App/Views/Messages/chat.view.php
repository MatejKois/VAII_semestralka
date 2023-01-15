<?php
/** @var \App\Controllers\ChatArguments $data */
/** @var \App\Core\IAuthenticator $auth */
?>

<?php if ($auth->isLogged() && $data) { ?>
    <!--    <div class="overflow-auto p-3 bg-light" style="height: 300px" id="chatwindow">-->
    <div class="chat-window">
        <div>
            <?php foreach ($data->getFilteredMessages() as $message) {
                $loggedID = \App\Models\User::getIdByLogin($auth->getLoggedUserName());
                if ($message->getUsersIdFrom() != $loggedID && $message->getUsersIdTo() != $loggedID) { ?>
                    <p style="color: red">Tieto správy nepatria Vám!!!</p>
                    <?php break;
                } ?>
                <p
                    <?php /** @var \App\Models\Message $message */
                    if ($message->getUsersIdFrom() == \App\Models\User::getIdByLogin($auth->getLoggedUserName())) { ?>
                        class="message-user"
                    <?php } ?>
                    <?php if ($message->getRead() == 0 && $message->getUsersIdTo() == \App\Models\User::getIdByLogin($auth->getLoggedUserName())) { ?>
                        class="message-unread"
                        <?php $message->setRead(1);
                        $message->save() ?>
                    <?php } ?>
                >
                    [<?php echo $message->getDate() ?>]
                    <?php echo \App\Models\User::getOne($message->getUsersIdFrom())->getLogin();
                    if ($message->getUsersIdFrom() == \App\Models\User::getIdByLogin($auth->getLoggedUserName())) { ?>
                        (Vy)
                    <?php } ?>
                    : <?php echo $message->getText(); ?>
                </p>
            <?php } ?>
        </div>
    </div>

    <form method="post" action="?c=messages&a=store">
        <input type="hidden" name="uid_from"
               value="<?php echo \App\Models\User::getIdByLogin($auth->getLoggedUserName()) ?>">
        <input type="hidden" name="uid_to" value="<?php echo $data->getUidTo() ?>">
        <div class="mb-3">
            <label class="form-label">Text správy</label>
            <textarea class="form-control" name="text" rows="3">

        </textarea>
        </div>
        <input type="submit" class="btn btn-primary mb-3" value="Odoslať">
    </form>
    <!--    <script>-->
    <!--        window.scrollTo(0, document.body.scrollHeight);-->
    <!--    </script>-->
<?php } ?>

<?php if (!$auth->isLogged()) { ?>
    <p style="color: red">Táto sekcia vyžaduje prihlásenie!</p>
<?php } ?>
