<?php 
// $users_arr = [
//   ['login' => 'manager-1', 'password' => 'manager-1', 'role' => 'author'],
//   ['login' => 'manager-2', 'password' => 'manager-2', 'role' => 'author'],
//   ['login' => 'master-1', 'password' => 'master-1', 'role' => 'subscriber'],
//   ['login' => 'master-2', 'password' => 'master-2', 'role' => 'subscriber'],
// ];
// foreach ($users_arr as $key => $value) {
//   wp_insert_user([
//     'user_login' => $value['login'],
//     'user_pass' => $value['password'],
//     'role' => $value['role'],
//   ]);
// }

for ($i=0; $i < 50; $i++) { 
  $post_id = wp_insert_post([
    'post_content' => 'Комментарий к заказу № '.$i,
    'post_status' => 'publish',
    'post_title' => 'Установка потолков закaзчику № '.$i,
    'post_type' => 'post',
    'post_category' => [get_category_by_slug('order')->term_id],
  ]);
  wp_update_post([
    'ID' => $post_id,
    'post_name' => 'order-'.$post_id,
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