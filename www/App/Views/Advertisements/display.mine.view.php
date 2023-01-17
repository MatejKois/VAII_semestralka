<?php

/** @var \App\Models\Advertisement[] $data */
/** @var \App\Core\IAuthenticator $auth */
?>

<h2>Moje inzeráty</h2>

<?php if ($auth->isLogged()) { ?>
    <div class="container">
        <div class="mb-3">
            <i class="bi bi-file-plus" style="font-size: x-large">
                <a href="?c=advertisements&a=create" class="card-action">Pridať inzerát</a>
            </i>
        </div>
    </div>
<?php } ?>

<div class="container">
    <?php foreach ($data as $ad) {
        if ($auth->isLogged() && \App\Models\User::getOne($ad->getUsersid())->getLogin() == $auth->getLoggedUserName()) { ?>
            <div class="card mb-4" style="@media only screen and (min-width: 1000px) {width: 45%}">
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
                    <i class="bi bi-pencil">
                        <a href="?c=advertisements&a=edit&id=<?php echo $ad->getId() ?>" class="card-action">Upraviť</a>
                    </i><br>
                    <i class="bi bi-trash">
                        <a href="?c=advertisements&a=delete&id=<?php echo $ad->getId() ?>"
                           class="card-action">Zmazať</a>
                    </i>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>
