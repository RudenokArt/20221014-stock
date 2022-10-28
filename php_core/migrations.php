<?php 
if (!get_page_by_path('login')->ID) {
  wp_insert_post([
    'post_type' => 'page',
    'post_title' => 'Авторизация',
    'post_name' => 'login',
    'post_status' => 'publish',
  ]);
}

?>