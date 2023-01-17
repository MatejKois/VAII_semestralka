<?php
/** @var \App\Controllers\ChatArguments $data */
/** @var \App\Core\IAuthenticator $auth */
?>

<?php if ($auth->isLogged() && $data) { ?>
    <div class="container container-chat">
        <div class="chat-window">
            <div>
                <?php foreach ($data->getFilteredMessages() as $message) {
                    $loggedID = $auth->getLoggedUserId();
                    if ($message->getUsersIdFrom() != $loggedID && $message->getUsersIdTo() != $loggedID) { ?>
                        <p style="color: red">Tieto správy nepatria Vám!!!</p>
                        <?php break;
                    } ?>
                    <p
                        <?php /** @var \App\Models\Message $message */
                        if ($message->getUsersIdFrom() == $auth->getLoggedUserId()) { ?>
                            class="message-user"
                        <?php } ?>
                        <?php if ($message->getRead() == 0 && $message->getUsersIdTo() == $auth->getLoggedUserId()) { ?>
                            class="message-unread"
                            <?php \App\Controllers\MessagesController::showMessageAsRead($message->getId()); ?>
                        <?php } ?>
                    >
                        [<?php echo $message->getDate() ?>]
                        <?php echo \App\Models\User::getOne($message->getUsersIdFrom())->getLogin();
                        if ($message->getUsersIdFrom() == $auth->getLoggedUserId()) { ?>
                            (Vy)
                        <?php } ?>
                        : <?php echo $message->getText();
                        if ($message->getUsersIdFrom() == $auth->getLoggedUserId()) { ?>
                            <a href="?c=messages&a=delete&id=<?php echo $message->getId() ?>&uid_from=<?php echo $message->getUsersIdFrom() ?>&uid_to=<?php echo $message->getUsersIdTo() ?>">
                                [Zmaž]
                            </a>
                            <a href="?c=messages&a=chat&edit_id=<?php echo $message->getId() ?>&uid_from=<?php echo $message->getUsersIdFrom() ?>&uid_to=<?php echo $message->getUsersIdTo() ?>">
                                [Uprav]
                            </a>
                        <?php } ?>
                    </p>
                <?php } ?>
            </div>
        </div>

        <form method="post" action="?c=messages&a=store<?php if ($data->getMessageToEditID() != -1) {
            echo "&id=" . $data->getMessageToEditID();
        } ?>" name="form-chat"
              onsubmit="
              const inputs = ['text'];
              return validateForm('form-chat', inputs)">
            <input type="hidden" name="uid_to" value="<?php echo $data->getUidTo() ?>">
            <div class="mb-3">
                <label class="form-label">Text správy</label>
                <textarea class="form-control" name="text" rows="3"><?php if ($data->getMessageToEditID() != -1) {
                        echo \App\Models\Message::getOne($data->getMessageToEditID())->getText();
                    } ?></textarea>
            </div>
            <input type="submit" class="btn btn-primary mb-3" value="<?php if ($data->getMessageToEditID() != -1) {
                echo "Uprav";
            } else {
                echo "Odoslať";
            } ?>">
        </form>
    </div>
<?php } ?>

<?php if (!$auth->isLogged()) { ?>
    <p style="color: red">Táto sekcia vyžaduje prihlásenie!</p>
<?php } ?>
