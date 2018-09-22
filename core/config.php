<?php
/**
* Конфиги
* 
* Содержит конфигурацию сайта!
* 
* @Vampqwe <Doktor_try@mail.ru>
* @version 0.0.1
* @copyright Copyright (c) 2018, Vampqwe
*/

/* Настройки базы данных */
define('DB_HOST', 'localhost'); //хост базы данных
define('DB_LOGIN', 'Vampqwe'); //Логин базы данных
define('DB_PASSWORD', 'Hdva4r81'); //Пароль базы данных
define('DB_NAME', 'mysite'); //Имя базы данных
define('DB_CHARSET', 'utf8'); //Кодировка базы данных
define('DB_DSN', "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET."");
$DB_OPTION = array (
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false
    );
/**
* Пути к корневым папкам
*/
define('CORE_CLASS', 'core/classes');
define('CLASSES', 'classes');
define('CORE', 'core');
define('STYLE', 'style');
	
/* меньше какого количества символов Логин считается не валидным */
define('MIN_SIZE_LOGIN', 6);
/* Больше какого количества символов Логин считается не валидным */
define('MAX_SIZE_LOGIN', 25);

/* меньше какого количества символов Пароль считается не валидным */
define('MIN_SIZE_PASS', 6);
/* Больше какого количества символов Пароль считается не валидным */
define('MAX_SIZE_PASS', 30);

/*какие символы удаляются из логина и пароля*/
define('PATTERN_LOGIN', [" ", "<", ">", "?", "{", "}", "[","]", "!", "@", "#"]);
define('PATTERN_PASS', [" ", "<", ">", "?", "{", "}", "[","]", "!", "@", "#"]);

/*Права пользователя*/
define('ACCES_NEW_USER', 1);
define('ACCES_ADMIN', 5);
