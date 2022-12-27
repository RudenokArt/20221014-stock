<?php 
if (!get_page_by_path('login')->ID) {
  wp_insert_post([
    'post_type' => 'page',
    'post_title' => 'Авторизация',
    'post_name' => 'login',
    'post_status' => 'publish',
  ]);
}
if (!get_page_by_path('profile')->ID) {
  wp_insert_post([
    'post_type' => 'page',
    'post_title' => 'Профиль',
    'post_name' => 'profile',
    'post_status' => 'publish',
  ]);
}
if (!get_page_by_path('index')->ID) {
  wp_insert_post([
    'post_type' => 'page',
    'post_title' => 'Главная',
    'post_name' => 'index',
    'post_status' => 'publish',
  ]);
}

$stock_migration = new Migration();

/**
 * 
 */
class Migration {

  function __construct() {

    $this->order_category = category_exists('order');

    if (!$this->order_category) {
      wp_insert_category([
        'cat_ID' => 0,
        'cat_name' => 'Заказ',
        'category_description' => 'Категория для заказов на бирже',
        'category_nicename' => 'order',
        'taxonomy' => 'category',
      ]);
    }
  }
}


?>