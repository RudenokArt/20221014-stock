<?php 
$current_page = explode('/', $_SERVER['REQUEST_URI'])[1];
if (!$GLOBALS['current_user']->data->ID and $current_page != 'login') {
  echo '<script>document.location.href="login";</script>';
}
if (isset($_GET['logout'])) {
  wp_logout();
  echo '<script>document.location.href="login";</script>';
}

$stock_pages = get_pages([
  'post_type' => 'page',
  'post_status' => 'publish',
  'exclude' => [
    get_page_by_path('login')->ID,
    get_page_by_path('alert')->ID,
  ]
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/assets/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/style.css">
  <script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/jquery-3.6.1.min.js"></script>
  <title>Document</title>
</head>
<body>
  <div class="container">
    <div class="row justify-content-end pt-5">
      <?php if ($GLOBALS['current_user']->data->ID): ?>
        <div class="col-6 col-sm-3 col-md-2 col-lg-2">
          <i class="fa fa-user-o" aria-hidden="true"></i>
          <?php echo $GLOBALS['current_user']->data->user_login; ?>
        </div>
        <div class="col-6 col-sm-3 col-md-2 col-lg-2">
          <a href="?logout=Y">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            Выход
          </a>
        </div>
      <?php endif ?>      
    </div>
    <div class="row">
      <div class="col-12">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link <?php if ($current_page == ''): ?>
            active
            <?php endif ?>" aria-current="page" href="/">Главная</a>
          </li>
          <?php foreach ($stock_pages as $key => $value): ?>
            <li class="nav-item">
              <a class="nav-link <?php if ($current_page == $value->post_name): ?>
              active
              <?php endif ?>" href="<?php echo $value->guid; ?>">
              <?php echo $value->post_title ?>
            </a>
          </li>
        <?php endforeach ?>
      </ul>
    </div>
  </div>
</div>


