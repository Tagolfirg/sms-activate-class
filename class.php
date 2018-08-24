/**
 * class for http://sms-activate.ru
 * Написал Alt+255
 * VK: https://vk.com/im?sel=c126
 */
class _ACT_SMS {
  public static $token;

  public static function getToken($tokens) {
    self::$token = $tokens;
  }

  public static function editStatus($id,$status,$forward='') {
    return self::error_verify(self::api('setStatus','status='.$status.'&id='.$id.'&forward='.$forward));
  }

  public static function buyNumber($service,$country,$operator='any',$ref='',$forward=0) {
    return self::error_verify( self::api('getNumber','service='.$service.'&forward='.$forward.'&operator='.$operator.'&ref='.$ref.'&country='.$country) );
  }

  public static function getNumbers($country='',$operator='') {
    $get = json_decode(self::api('getNumbersStatus','country='.$country.'&operator='.$operator),1);
    return $get;
  }

  public static function getStatus($ids) {
    return self::error_verify( self::api('getStatus','id='.$ids) );
  }

  public static function getNumbersArr($country_arr=[],$operator='') { $array_number = [];
    $countryarr = ['Россия','Украина','Казахстан','Китай','Филиппины','Мьянма','Индонезия','Малайзия','Кения', 'Танзания','Вьетнам','Кыргызстан', 'США', 'Израиль','Гонконг', 'Польша'];
    foreach ($country_arr as $key => $value) {
      if ($country_arr == 0 ) {
        $array_number[$countryarr[$value]] = self::getNumbers($value,$operator);
      } else {
        $array_number[$countryarr[$value]] = self::getNumbers($value,'');
      }
    }
    return $array_number;
  }

  public static function getBalance() {
    $balance = self::api('getBalance','');
    return self::error_verify($balance);
  }

  public static function error_verify($param){ $status = [];
    if ( stristr($param,'ACCESS_READY') ) {
      $status['success'] = 'Готовность номера подтверждена';
    } elseif ( stristr($param,'ACCESS_RETRY_GET') ) {
      $status['success'] = 'Ожидание нового смс';
    } elseif ( stristr($param,'ACCESS_ACTIVATION') ) {
      $status['success'] = 'Сервис успешно активирован';
    } elseif ( stristr($param,'ACCESS_CANCEL') ) {
      $status['success'] = 'Активация отменена';
    } elseif ( stristr($param,'NO_ACTIVATION') ) {
      $status['error'] = 'id активации не существует';
    } elseif ( stristr($param,'BAD_SERVICE') ) {
      $status['error'] = 'Некорректное наименование сервиса';
    } elseif ( stristr($param,'ERROR_SQL') ) {
      $status['error'] = 'Ошибка SQL-сервера';
    } elseif ( stristr($param,'BAD_STATUS') ) {
      $status['error'] = 'Некорректный статус';
    } elseif ( stristr($param,'BAD_KEY') ) {
      $status['error'] = 'Неверный API-ключ';
    } elseif ( stristr($param,'BAD_ACTION') ) {
      $status['error'] = 'Некорректное действие';
    } elseif ( stristr($param,'ACCESS_BALANCE') ) {
      $status['success'] = ['balance'=>explode(':',$param)[1]];
    } elseif ( stristr($param,'WRONG_SERVICE') ) {
      $status['error'] = 'Некорректное наименование сервиса';
    } elseif ( stristr($param,'BANNED') ) {
      $status['error'] = 'Аккаунт заблокирован до '.explode(':',$param)[1];
    } elseif ( stristr($param,'NO_BALANCE') ) {
      $status['error'] = 'Закончился баланс';
    } elseif ( stristr($param,'NO_NUMBERS') ) {
      $status['error'] = 'Нет номеров';
    } elseif ( stristr($param,'ACCESS_NUMBER') ) {
      $status['success'] = ['Номер выдан',explode(':',$param)[1],explode(':',$param)[2]];
    } elseif ( stristr($param,'STATUS_WAIT_CODE') ) {
      $status['success'] = 'Ожидание смс';
    } elseif ( stristr($param,'STATUS_WAIT_RETRY') ) {
      $status['success'] = 'Ожидание уточнения кода (где $lastcode - прошлый, неподошедший код)';
    } elseif ( stristr($param,'STATUS_WAIT_RESEND') ) {
      $status['success'] = 'Ожидание повторной отправки смс (софт должен нажать повторно выслать смс и выполнить изменение статуса на 6)';
    } elseif ( stristr($param,'STATUS_CANCEL') ) {
      $status['success'] = 'Активация отменена';
    } elseif ( stristr($param,'STATUS_OK') ) {
      $status['success'] = ['code'=>explode(':',$param)[1],'Код получен (где $code - код активации)'];
    } elseif ( stristr($param,'ACCESS_CONFIRM_GET') ) {
      $status['success'] = 'Активация отменена';
    } else {
      $status[] = $param;
    }
    return $status;
  }

  public static function api($method,$param) {
    $json = file_get_contents('http://sms-activate.ru/stubs/handler_api.php?api_key='.self::$token.'&action='.$method.'&'.$param);
    return $json;
  }
}
