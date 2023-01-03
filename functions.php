<?php 
require_once ABSPATH . '/wp-admin/includes/taxonomy.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
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



// ?tg_bot=Y&user=720796397&action=registration
// ?tg_bot=Y&user=720796397&action=recovery


?>