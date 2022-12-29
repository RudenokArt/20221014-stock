<?php 

// ===== Страницы =====
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
if (!get_page_by_path('alert')->ID) {
  wp_insert_post([
    'post_type' => 'page',
    'post_title' => 'alert',
    'post_name' => 'alert',
    'post_status' => 'publish',
  ]);
}

// ===== Рубрики =====
if (!category_exists('order')) {
  wp_insert_category([
    'cat_ID' => 0,
    'cat_name' => 'Заказ',
    'category_description' => 'Категория для заказов на бирже',
    'category_nicename' => 'order',
    'taxonomy' => 'category',
  ]);
}



?>