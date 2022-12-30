<?php 

for ($i=0; $i < 50; $i++) { 
  $post_id = wp_insert_post([
    'post_content' => 'Комментарий к заказу № '.$i,
    'post_status' => 'publish',
    'post_title' => 'Установка потолков закaзчику № '.$i,
    'post_type' => 'post',
    'post_category' => [get_category_by_slug('order')->term_id],
  ]);
  if ($post_id) {
    add_post_meta($post_id, 'customer_name', 'ФИО № '.$i);
    add_post_meta($post_id, 'customer_phone', '123456789');
    add_post_meta($post_id, 'customer_email', 'email@mail.ru');
    add_post_meta($post_id, 'customer_address', 'Адрес заказчка № '.$i);
    add_post_meta($post_id, 'order_status', 0);
    add_post_meta($post_id, 'order_contractor', 0);
  } 
}




?>