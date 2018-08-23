# Class для сайта http://sms-activate.ru/
<body>
  <h4>1.API TOKEN - getToken</h4>
  <p>Получаем личный TOKEN перейдя по этой ссылке http://sms-activate.ru/index.php?act=profile<br/>
  Подключаем class удобным для Вас способом. Я использую функцию "require_once 'class.php';" и объявляете токен:
  <b>_ACT_SMS::getToken( '07bd7A17ergergergegerg2f3f1cf37' ); </b> без этой строки class не будет работать!
  </p>
  <hr>
  <h4>2.Функция проверки баланса - getBalance</h4>
  <p>Вызываем функцию таким спосбом:<b> " $balance = _ACT_SMS::getBalance(); " </b></p>
  <hr>
  <h4>3.Функция получения информации о наличии номеров - getNumbers </h4>
  <br/>
  <p> Вызываем функцию таким спосбом:<b> " $getNumbers = _ACT_SMS::getNumbers($country,$operator); " </b> <br/>
    $country - номер страны.<br/>
    <b>0 - Россия, 1 - Украина, 2 - Казахстан, 3 - Китай, 4 - Филиппины, 5 - Мьянма, 6 - Индонезия, 7 - Малайзия, 8 - Кения, 9 - Танзания, 10 - Вьетнам, 11 - Кыргызстан, 12 - США, 13 - Израиль, 14 - Гонконг, 15 - Польша</b> <br/>
    $operator - сотовый оператор.<br/>
  </p>
</body>
