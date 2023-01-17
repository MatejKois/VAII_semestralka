<?php
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title><?= \App\Config\Configuration::APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../public/css/styl.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="../../public/js/script.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-light">
    <a class="navbar-brand" href="?c=home">
        <img src="public/images/Autobazar_Logo.png" title="<?= \App\Config\Configuration::APP_NAME ?>">
    </a>
    <ul class="navbar-nav me-auto">
        <li class="nav-item">
            <a class="nav-link" href="?c=advertisements">Všetky inzeráty</a>
        </li>
        <?php if ($auth->isLogged()) { ?>
            <li class="nav-item">
                <a class="nav-link" href="?c=advertisements&a=displayMine">Moje inzeráty</a>
            </li>
        <?php } ?>
    </ul>
    <?php if ($auth->isLogged()) { ?>
        <span class="navbar-text">Prihlásený používateľ: <b><?= $auth->getLoggedUserName() ?></b></span>
        <ul class="navbar-nav ms-auto">
            <?php $conversations = \App\Models\Conversation::getAll();
            $showNew = false;
            foreach ($conversations as $conversation) {
                if ($conversation->getHasNewMessage() == $auth->getLoggedUserId()) {
                    $showNew = true;
                    break;
                }
            }
            if ($showNew) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="?c=conversations" style="font-weight: bold">Správy <span
                                class="badge bg-primary">nové</span></a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="?c=conversations">Správy</a>
                </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link" href="?c=auth&a=logout">Odhlásenie</a>
            </li>
        </ul>
    <?php } else { ?>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="?c=users&a=signup">Zaregistrovať</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= \App\Config\Configuration::LOGIN_URL ?>">Prihlásenie</a>
            </li>
        </ul>
    <?php } ?>
</nav>
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col col-with-background-left"></div>
        <div class="col-7">
            <div class="web-content">
                <?= $contentHTML ?>
            </div>
        </div>
        <div class="col col-with-background-right"></div>
    </div>
</div>
</body>
</html>
