<?php
/** @var \App\Core\IAuthenticator $auth */ ?>

<h2>Všetky inzeráty</h2>

<div class="container">
    <?php
    $data = \App\Models\Advertisement::getAll();
    $step = 3; //kolko kariet chcem vyobrazit vedla seba
    $j = 0;
    while ($j < count($data)) { ?>
        <div class="row">
            <?php
            for ($i = $j; $i < $j + $step && $i < count($data); $i++) {
                $ad = $data[$i]; ?>
                <!--            --><?php //(new App\Controllers\AdvertisementsController)->displaySingle($ad) ?>
                <div class="card m-2">
                    <?php if ($ad->getImg()) { ?>
                        <img alt="" src="<?php echo $ad->getImg() ?>" class="card-img-top">
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
                                <a href="?c=advertisements&a=edit&id=<?php echo $ad->getId() ?>" class="card-action">Upraviť</a>
                            </i><br>
                            <i class="bi bi-trash">
                                <a href="?c=advertisements&a=delete&id=<?php echo $ad->getId() ?>" class="card-action">Zmazať</a>
                            </i>
                        <?php } ?>
                        <?php if ($auth->isLogged() && \App\Models\User::getOne($ad->getUsersid())->getLogin() != $auth->getLoggedUserName()) { ?>
                            <i class="bi bi-envelope-fill">
                                <a href="?c=conversations&a=store&uid_from=<?php echo $auth->getLoggedUserId() ?>&uid_to=<?php echo $ad->getUsersid() ?>"
                                   class="card-action"
                                >Kontaktovať</a>
                            </i>
                        <?php } ?>
                    </div>
                </div>
            <?php }
            $j += $step; ?>
        </div>
    <?php } ?>
</div>
