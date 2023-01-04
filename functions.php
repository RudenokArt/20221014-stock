<?php 
require_once ABSPATH . '/wp-admin/includes/taxonomy.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
include_once 'php_core/Helper.php';
if ($_GET['migrations'] == 'Y') {
  include_once 'php_core/migrations.php'; // файл миграций
}

if ($_GET['seeders'] == 'Y') {
  include_once 'php_core/seeders.php'; // файл сидеров
}

if (isset($_GET['tg_bot'])) {
  include_once 'php_core/Tg_bot.php';
  echo (new Tg_bot())->result;
  exit();
}

$order_statuses_arr = [
  ['title'=> 'Новый', 'color' => 'primary',],
  ['title'=> 'В работе', 'color' => 'info',],
  ['title'=> 'Выполнен', 'color' => 'warning',],
  ['title'=> 'Оплачен', 'color' => 'success',],
  ['title'=> 'Анулирован', 'color' => 'danger',],
];
$stock_helper = new Helper();

// ?tg_bot=Y&user=720796397&action=registration
// ?tg_bot=Y&user=720796397&action=recovery


?>