<?php 


$post_id = wp_update_post( wp_slash([
  'ID' => $_POST['order_id'],
  'post_content' => $_POST['post_content'],
]));

update_post_meta( $_POST['order_id'], 'order_status', $_POST['order_status'] );
$alert_message = 'Выполнено обновление заказа № '.$_POST['order_id'];
$alert_color = 'success';
echo '<meta http-equiv="refresh" content="2; url='.$_SERVER['HTTP_REFERER'].'" />';


?>

<b><?php echo $post_id; ?></b>