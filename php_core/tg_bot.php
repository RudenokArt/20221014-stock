<?php 

/**
 * 
 */
class Tg_bot {

  function __construct()  {
    $this->user = get_users([
      'login' => $_GET['user'],
    ]);
    $this->new_password = $this->passGenerate();
    $this->user_check = $this->userCheck();
    if ($this->user_check and $_GET['action'] == 'registration') {
      $this->result =  json_encode(['result' => 'error', 'error' => 'already_registred']);
    } else { 
      $this->new_user_id = wp_create_user($_GET['user'], $this->new_password);
      $this->result =  json_encode(['result' => 'success','id' => $this->new_user_id]);
    }
  }

  function passGenerate () {
    $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
    $numChars = strlen($chars);
    $string = '';
    for ($i = 0; $i < 10; $i++) {
      $string .= substr($chars, rand(1, $numChars) - 1, 1);
    }
    return $string;
  }

  function userCheck () {
    if ($this->user[0]) {
      return true;
    } else return false;
  }

}




?>
