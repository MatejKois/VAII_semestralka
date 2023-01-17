<div class="container container-login">
    <div class="text-center text-danger mb-3">
        <?= /** @var array $data */
        @$data['message'] ?>
    </div>
    <form method="post" action="?c=users&a=store" name="form-signup">
        <div class="mb-3">
            <label class="form-label">Login</label>
            <input type="text" name="login" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Heslo</label>
            <input type="password" name="password" id="passowrd" class="form-control">
        </div>
        <script>
            evaluatePassword('form-signup', 'password');
        </script>
        <input type="submit" class="btn btn-primary mb-3" value="Zaregistrovať">
    </form>
</div>
