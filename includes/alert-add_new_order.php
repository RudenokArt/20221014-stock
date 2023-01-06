<?php 

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


?>