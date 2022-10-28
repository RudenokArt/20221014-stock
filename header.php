<?php 
$current_page = basename(get_permalink());
if (!$GLOBALS['current_user']->data->ID and $current_page != 'login') {
  echo '<script>document.location.href="login";</script>';
}
if (isset($_GET['logout'])) {
  wp_logout();
  echo '<script>document.location.href="login";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/assets/font-awesome/css/font-awesome.min.css">
  <script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/jquery-3.6.1.min.js"></script>
  <title>Document</title>
</head>
<body>
  <div class="container">
    <div class="row pt-5">
      <?php if ($GLOBALS['current_user']->data->ID): ?>
        <div class="col-12 col-sm-6 col-md-4 col-sx-2">
          <i class="fa fa-user-o" aria-hidden="true"></i>
          <?php echo $GLOBALS['current_user']->data->user_login; ?>
          <br>Пользователь авторизован.
          <br>Здесь будет вход в кабинет.
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-sx-2">
          <a href="?logout=Y">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            Выход
          </a>
        </div>
      <?php endif ?>      
    </div>
  </div>
