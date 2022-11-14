<?php

/** @var \App\Models\Advertisement[] $data */
/** @var \App\Core\IAuthenticator $auth */
?>

<div>
    <?php
    if ($auth->isLogged()) { ?>
        <div class="mb-3">
            <i class="bi bi-file-plus" style="font-size: x-large">
                <a href="?c=advertisements&a=create">Pridať inzerát</a>
            </i>
        </div>
    <?php } ?>
</div>

<?php
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
                <?php echo $ad->getPrice() ?> €
            </h5>
            <?php
            if ($auth->isLogged()) { ?>
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