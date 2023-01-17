<div class="container container-login">
    <div class="text-center text-danger mb-3">
        <?= /** @var array $data */
        @$data['message'] ?>
    </div>
    <form method="post" action="?c=users&a=store" name="form-signup"
          onsubmit="
              const inputs = ['login', 'password'];
              return validateForm('form-signup', inputs)">
        <div class="mb-3">
            <label class="form-label">Login</label>
            <input type="text" name="login" class="form-control">
        </div>
        <div class="mb-3" id="div-password-input">
            <label class="form-label">Heslo</label>
            <input type="password" name="password" id="passowrd" class="form-control">
        </div>
        <script>
            evaluatePassword('form-signup', 'password', 'div-password-input');
        </script>
        <input type="submit" class="btn btn-primary mb-3" value="Zaregistrovať">
    </form>
</div>
