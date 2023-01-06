<?php
// ===== Показ ошибок =====
include_once 'includes/display_errors.php';

 // ===== Создание заказа =====
if (isset($_POST['add_new_order']) and $_POST['add_new_order'] == 'Y') {
  include_once 'includes/alert-add_new_order.php';
} 

// ===== Обновление заказа =====
elseif (isset($_POST['order_update']) and $_POST['order_update'] == 'Y') {
  include_once 'includes/alert-order_update.php';
}

elseif ($_GET['order_contractor']) {
  $update_result = update_post_meta( $_GET['ID'], 'order_contractor', $_GET['order_contractor'] );
  if ($update_result) {
    $alert_message = 'Вы определены исполнителем по закузу № '.$_GET['ID'];
    $alert_color = 'success';
  } else {
    $alert_message = 'Ошибка базы дынных';
    $alert_color = 'danger';
  }
  echo '<meta http-equiv="refresh" content="2; url='.$_SERVER['HTTP_REFERER'].'" />';
}

// ===== На главную =====
else {
  echo '<script>document.location.href="/";</script>';
  exit();
}


?>



<?php get_header(); ?>

<div class="container pt-5">
  <div class="alert alert-<?php echo $alert_color; ?> text-center" role="alert">
    <?php echo $alert_message; ?>
  </div>
</div>

<?php get_footer(); ?>