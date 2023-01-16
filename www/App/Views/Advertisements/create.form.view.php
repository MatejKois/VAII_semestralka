<div class="container container-create-ad">
    <form method="post" action="?c=advertisements&a=store" enctype="multipart/form-data">
        <?php
        /** @var \App\Models\Advertisement $data */
        if ($data) {
            if ($data->getId()) { ?>
                <input type="hidden" name="id" value="<?php echo $data->getId() ?>">
            <?php }
            if ($data->getUsersid()) { ?>
                <input type="hidden" name="user_id" value="<?php echo $data->getUsersid() ?>">
            <?php } ?>
        <?php } ?>
        <div class="mb-3">
            <label class="form-label">Titulok</label>
            <input type="text" name="title" class="form-control" placeholder="Titulok" value="<?php echo $data ? $data->getTitle() : null ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Cena</label>
            <input type="number" name="price" class="form-control" value="<?php echo $data ? $data->getPrice() : null ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Text inzerátu</label>
            <textarea class="form-control" name="text" rows="3">
            <?php echo $data ? $data->getText() : null ?>
        </textarea>
        </div>
        <?php if (!$data) { ?>
            <div class="mb-3">
                <label class="form-label">Obrázok</label>
                <input class="form-control" type="file" name="img">
            </div>
        <?php } ?>
        <input type="submit" class="btn btn-primary mb-3" value="Odoslať">
    </form>
</div>
