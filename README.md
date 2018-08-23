# Class для сайта http://sms-activate.ru/
<body>
  <h4>1.API TOKEN - getToken</h4>
  <p>Получаем личный TOKEN перейдя по этой ссылке http://sms-activate.ru/index.php?act=profile<br/>
  Подключаем class удобным для Вас способом. Я использую функцию "require_once 'class.php';" и объявляете токен:
  <b>_ACT_SMS::getToken( '07bd7A17ergergergegerg2f3f1cf37' ); <b/> без этой строки class не будет работать!
  </p>
  <hr>
  <h4>2.Функция проверки баланса - getBalance</h4>
  <p>Вызываем функцию таким спосбом:<b> " $balance = _ACT_SMS::getBalance(); " </b></p>
  <hr>
  <h4>3.Функция получения информации о наличии номеров - getNumbers </h4>
  <p> Вызываем функцию таким спосбом:<b> " $getNumbers = _ACT_SMS::getNumbers($country,$operator); " </b>
    Где $country - это номер страны, номера которой Вам нужны.
        $operator - это сотовый оператор
  </p>
</body>
