<div class="container-fluid">
    <div class="row">
        <div class="col mt-5">
            <div class="text-center">
                <h1 style="font-weight: bold">Autobazár</h1>
                <img class="logo-image" src="public/images/Autobazar_Logo.png">
                <p class="p-welcome-text">
                    Vitajte na stránke Autobazár!<br>
                    Prezrite si všetky inzeráty, alebo sa
                    <?php /** @var \App\Core\IAuthenticator $auth */
                    if ($auth->isLogged()) { ?>
                        prihláste
                    <?php } else { ?>
                        <a href="<?php echo \App\Config\Configuration::LOGIN_URL ?>"
                           class="prihlasenie-link">prihláste</a>
                    <?php } ?>
                    pre vytvorenie vlastného.<br>
                </p>
                <img class="title-image" src="public/images/auto-ms-kosice-autobazar-1140x550.png">
            </div>
        </div>
    </div>
    <h2>Najnovšie inzeráty</h2>
    <?php
    /** @var \App\Core\IAuthenticator $auth */
    $data = \App\Models\Advertisement::getAll(); ?>
    <div class="container">
        <div class="row">
            <?php
            for ($i = count($data) - 1; $i >= count($data) - 3; $i--) {
                $ad = $data[$i]; ?>
                <div class="card m-2">
                    <div class="container">
                        <?php if ($ad->getImg()) { ?>
                            <img src="<?php echo $ad->getImg() ?>" class="card-img-top">
                        <?php } ?>
                    </div>
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
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
