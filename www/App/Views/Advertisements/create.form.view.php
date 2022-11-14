<form method="post" action="?c=advertisements&a=store">
    <?php
    /** @var \App\Models\Advertisement $data */
    if ($data) {
        if ($data->getId()) { ?>
            <input type="hidden" name="id" value="<?php echo $data->getId() ?>">
        <?php }
    } ?>
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
        <input type="text" name="text" class="form-control" value="<?php echo $data ? $data->getText() : null ?>">
    </div>
    <input type="submit" class="btn btn-primary mb-3" value="Odoslať">
</form>
