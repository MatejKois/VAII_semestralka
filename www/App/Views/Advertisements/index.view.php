<?php
/** @var \App\Core\IAuthenticator $auth */ ?>

<h2>Všetky inzeráty</h2>

<?php
$data = \App\Models\Advertisement::getAll();
$step = 3; //kolko kariet chcem vyobrazit vedla seba
$j = 0;
while ($j < count($data)) { ?>
    <div class="row">
    <?php
    for ($i = $j; $i < $j + $step && $i < count($data); $i++) {
        $ad = $data[$i]; ?>
        <div class="card m-2" style="width: 20rem;">
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
    <?php }
    $j += $step; ?>
    </div> <?php
}
