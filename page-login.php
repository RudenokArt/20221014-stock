<?php
if (isset($_POST['authorization'])) {
  $authorization = wp_signon([
    'user_login' => $_POST['login'],
    'user_password' => $_POST['password'],
  ], false);
  if (!is_wp_error($authorization)) {
    echo '<script>document.location.href="../";</script>';
  }
}
?>

<?php get_header(); ?>
<?php if (is_wp_error($authorization) and $_POST['authorization']): ?>
  <div class="container">
    <div class="alert alert-danger" role="alert">
      Ошибка авторизации. Неверный логин или пароль!
    </div>
  </div>
<?php endif ?>
<form action="" method="post">
  <div class="container pt-5">
    <div class="row justify-content-center pt-1">
      <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="container border pb-5 pt-5">
          <div class="row">
            <div class="col-12">
              Логин:
              <input name="login" type="text" class="form-control">
            </div>
          </div>
          <div class="row pt-1">
            <div class="col-12">
              Пароль:
              <input name="password" type="text" class="form-control">
            </div>
          </div>
          <div class="row pt-3">
            <div class="col-12">
              <button class="btn btn-outline-success w-100" name="authorization" value="Y">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
                Вход
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<pre><?php print_r($_POST); ?></pre>
<?php get_footer(); ?>