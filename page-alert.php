<?php
// ===== Показ ошибок =====
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// ===== Создание заказа =====
if ($_POST['add_new_order'] == 'Y') {
  $post_id = wp_insert_post([
    'post_content' => $_POST['order_description'],
    'post_status' => 'publish',
    'post_title' => $_POST['order_title'],
    'post_type' => 'post',
    'post_category' => [get_category_by_slug('order')->term_id],
  ]);
  if (!$post_id) {
    $alert_message = 'При сохранении заказа возникла ошибка!';
    $alert_color = 'danger';
  } else {
    $alert_message = 'Создан заказ № '.$post_id;
    $alert_color = 'success';
    add_post_meta($post_id, 'customer_name', $_POST['customer_name']);
    add_post_meta($post_id, 'customer_phone', $_POST['customer_phone']);
    add_post_meta($post_id, 'customer_email', $_POST['customer_mail']);
    add_post_meta($post_id, 'customer_address', $_POST['customer_address']);
    add_post_meta($post_id, 'order_status', 0);
    add_post_meta($post_id, 'order_contractor', 0);
  }
} else {
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