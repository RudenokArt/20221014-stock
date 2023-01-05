<?php
// ===== Показ ошибок =====
include_once 'includes/display_errors.php';

 // ===== Создание заказа =====
if (isset($_POST['add_new_order']) and $_POST['add_new_order'] == 'Y') {
  $post_id = wp_insert_post([
    'post_content' => $_POST['order_description'],
    'post_status' => 'publish',
    'post_title' => $_POST['order_title'],
    'post_type' => 'post',
    'post_category' => [get_category_by_slug('order')->term_id],
  ]);
  wp_update_post([
    'ID' => $post_id,
    'post_name' => 'order-'.$post_id,
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
    if ($_FILES['order_attachment']['tmp_name']) {
      if (!is_dir('wp-content/uploads/orders/')) {
        mkdir('wp-content/uploads/orders/');
      }
      $order_attachment = $post_id.'.'.explode('.', $_FILES['order_attachment']['name'])[1];
      move_uploaded_file($_FILES['order_attachment']['tmp_name'],
        'wp-content/uploads/orders/'.$order_attachment);
      add_post_meta($post_id, 'order_attachment', $order_attachment);
    }
    echo '<meta http-equiv="refresh" content="2; url=/order-'.$post_id.'" />';
  }
  

} 
// ===== Обновление заказа =====
elseif (isset($_POST['order_update']) and $_POST['order_update'] == 'Y') { 
  update_post_meta( $_POST['order_id'], 'order_status', $_POST['order_status'] );
  $alert_message = 'Выполнено обновление заказа № '.$_POST['order_id'];
  $alert_color = 'success';
  echo '<meta http-equiv="refresh" content="2; url='.$_SERVER['HTTP_REFERER'].'" />';
} else {
  echo '<script>document.location.href="/";</script>';
  exit();
}


?>



<?php get_header(); ?>

<pre><?php print_r($_SERVER['HTTP_REFERER']); ?></pre>

<div class="container pt-5">
  <div class="alert alert-<?php echo $alert_color; ?> text-center" role="alert">
    <?php echo $alert_message; ?>
  </div>
</div>

<?php get_footer(); ?>