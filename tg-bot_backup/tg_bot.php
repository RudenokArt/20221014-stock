<?php 

/**
 * 
 */

class Tg_bot {

  function __construct($php_input_json)  {
    $this->url = 'https://api.telegram.org/bot5779405986:AAExrHLhMBmA-HLstR1DbUdcQO05TCL65uo/';
    $this->greeteng = 'Чем могу вам помочь? Выбирете нужный вам пункт:';
    $this->php_input_json = $php_input_json;
    $this->php_input_arr = json_decode($php_input_json, true);
    if ($this->php_input_arr['message']) {
      $this->user_id = $this->php_input_arr['message']['from']['id'];
      $this->sendButtons();
    }
    if ($this->php_input_arr['callback_query']) {
      $this->user_id = $this->php_input_arr['callback_query']['from']['id'];
      if ($this->php_input_arr['callback_query']['data'] == 'registration') {
        $this->registration();
      }
      if ($this->php_input_arr['callback_query']['data'] == 'recovery') {
        $this->recovery();
      }
      
    }
  }

  function registration () {
    $response = file_get_contents('https://cx57370.tmweb.ru/stock/?tg_bot=Y&user='.$this->user_id.'&action=registration');
    $result = json_decode($response, true);
    if ($result['result'] == 'error') {
      $this->sendBootMessage('Вы уже зарегистрированы в базе данных. Ваш логин: '.$this->user_id);
    } elseif ($result['result'] == 'success') {
      $this->sendBootMessage('Регистрация прошла успешно. Ваш логин: '
        .$this->user_id.' Ваш пароль: '.$result['password'].' Вы сможете поменять пароль в личном кабинете.');
    } else {
      $this->sendBootMessage('Ошибка сервера!');
    }
    
  }

  function recovery () {
    $response = file_get_contents('https://cx57370.tmweb.ru/stock/?tg_bot=Y&user='.$this->user_id.'&action=recovery');
    $result = json_decode($response, true);
    if ($result['result'] == 'error') {
      $this->sendBootMessage('Вы не зарегистрированы в базе данных!');
    } elseif ($result['result'] == 'success') {
      $this->sendBootMessage('Изменение пароля прошло успешно. Ваш логин: '
        .$this->user_id.' Ваш пароль: '.$result['password'].' Вы сможете поменять пароль в личном кабинете.');
    } else {
      $this->sendBootMessage('Ошибка сервера!');
    }
  }


  function sendButtons () {
    $keyboard = [
      'inline_keyboard' => [
        [['text' =>  'Я хочу зарегистрироваться', 'callback_data' =>'registration']],
        [['text' =>  'Я забыл свой пароль (логин)', 'callback_data' =>'recovery']],
      ],
    ];
    $reply = json_encode($keyboard);
    file_get_contents($this->url."/sendMessage?chat_id=".$this->user_id."&text=".$this->greeteng."&reply_markup=".$reply);
  }

  function sendBootMessage ($message_text='') {
    if (!$message_text) {
      $message_text = $this->greeteng;
    }
    file_get_contents($this->url.'sendMessage?chat_id='.$this->user_id.'&text='.$message_text);
  }
}

?>