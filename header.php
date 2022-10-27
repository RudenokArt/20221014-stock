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
      <div class="col-12 col-sm-6 col-md-4 col-sx-2">
        <?php if (is_user_logged_in()): ?>
        <i class="fa fa-user-o" aria-hidden="true"></i>
      <?php else: ?>
        <button class="btn btn-outline-info">
          login
        </button>
      <?php endif ?>
      </div>
      
    </div>
  </div>

  <pre><?php print_r(wp_get_current_user());?></pre>
