<?php 


if (isset($_GET['tg_bot'])) {
  include_once 'php_core/Tg_bot.php';
  echo (new Tg_bot())->result;
  exit();
}

//var_dump(add_user_meta( 2, 'tg_id', '123456789', true));
//print_r(get_user_meta(2));
// ?tg_bot=Y&user=720796397&action=registration
// ?tg_bot=Y&user=123456789&action=registration


?>