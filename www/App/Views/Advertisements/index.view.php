<?php

/** @var \App\Models\Advertisement[] $data */
/** @var \App\Core\IAuthenticator $auth */

foreach ($data as $ad) { ?>
    <div class="card mb-4" style="width: 20rem;">
        <?php if ($ad->getImg()) { ?>
            <img src="<?php echo $ad->getImg() ?>" class="card-img-top">
        <?php } ?>
        <div class="card-body">
            <h5 class="card-title">
                <?php echo $ad->getTitle() ?>
            </h5>
            <h5 class="card-title">
                <?php echo $ad->getPrice() ?> &euro;
            </h5>
            <p class="card-text">
                <?php echo $ad->getText() ?>
            </p>
            <p class="card-text">
                <?php echo "Pridal: " . \App\Models\User::getOne($ad->getUsersid())->getLogin() ?>
            </p>
            <?php
            if ($auth->isLogged() && \App\Models\User::getOne($ad->getUsersid())->getLogin() == $auth->getLoggedUserName()) { ?>
                <i class="bi bi-pencil">
                <a href="?c=advertisements&a=edit&id=<?php echo $ad->getId() ?>">Upraviť</a>
                </i><br>
                <i class="bi bi-trash">
                    <a href="?c=advertisements&a=delete&id=<?php echo $ad->getId() ?>">Zmazať</a>
                </i>
            <?php } ?>
        </div>
    </div>
<?php } ?>
