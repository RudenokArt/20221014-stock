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
      $this->result =  json_encode([
        'result' => 'error',
        'error' => 'already_registred',
      ]);
    } elseif ($_GET['action'] == 'registration') { 
      $this->new_user_id = wp_create_user($_GET['user'], $this->new_password);
      $this->result =  json_encode([
        'result' => 'success',
        'password' => $this->new_password,
        'login' => $_GET['user'],
      ]);
    }

    elseif (!$this->user_check and $_GET['action'] == 'recovery') {
      $this->result =  json_encode([
        'result' => 'error',
        'error' => 'not_registred',
      ]);
    } elseif ($_GET['action'] == 'recovery') {
      $this->new_user_id = wp_set_password($this->new_password, $this->user[0]->data->ID);
      $this->result =  json_encode([
        'result' => 'success',
        'password' => $this->new_password,
        'login' => $_GET['user'],
      ]);
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
