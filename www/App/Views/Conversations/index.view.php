<?php
/** @var \App\Core\IAuthenticator $auth */
$conversations = \App\Models\Conversation::getAll();
$users = \App\Models\User::getAll();
if ($auth->isLogged()) { ?>
    <div class="container container-conversations" style="padding: 10px">
        <form class="col-md-4" method="post" action="?c=conversations&a=store">
            <label>Nová konverzácia</label>
            <select class="form-control select2" name="uid_to">
                <?php foreach ($users as $user) {
                    if ($user->getLogin() != $auth->getLoggedUserName()) { ?>
                        <option value="<?php echo $user->getId() ?>"><?php echo $user->getLogin() ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
<!--            <input type="hidden" name="uid_from"-->
<!--                   value="--><?php //echo $auth->getLoggedUserId() ?><!--">-->
            <input type="submit" class="btn btn-primary mb-3" value="Začni" style="margin-top: 10px">
        </form>
    </div>
    <script>
        $('.select2').select2();
    </script>

    <div class="container container-conversations">
        <label>Aktívne konverzácie</label>
        <div>
            <?php foreach ($conversations as $conversation) {
                if ($conversation->getUsersId1() == $auth->getLoggedUserId()) { ?>
                    <a href="?c=messages&a=chat&uid_from=<?php echo $conversation->getUsersId1() ?>&uid_to=<?php echo $conversation->getUsersId2() ?>"
                        <?php if ($conversation->getHasNewMessage() == $auth->getLoggedUserId()) { ?>
                            style="font-weight: bold"
                            <?php \App\Controllers\ConversationsController::hideNewMessage($conversation);
                        } ?>
                    >
                        <?php echo \App\Models\User::getLoginById($conversation->getUsersId2()) ?>
                    </a><br>
                <?php }
                if ($conversation->getUsersId2() == $auth->getLoggedUserId()) { ?>
                    <a href="?c=messages&a=chat&uid_from=<?php echo $conversation->getUsersId2() ?>&uid_to=<?php echo $conversation->getUsersId1() ?>"
                        <?php if ($conversation->getHasNewMessage() == $auth->getLoggedUserId()) { ?>
                            style="font-weight: bold"
                            <?php \App\Controllers\ConversationsController::hideNewMessage($conversation);
                        } ?>
                    >
                        <?php echo \App\Models\User::getLoginById($conversation->getUsersId1()) ?>
                    </a><br>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
<?php } ?>
