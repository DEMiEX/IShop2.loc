<?php

define("DEBUG", 0);                                         //Флаг отладки
define("ROOT", dirname(__DIR__));                           //Корень
define("WWW", ROOT . '/public');                            //Директория общего доступа
define("APP", ROOT . '/app');                               //Директория приложения
define("CORE", ROOT . '/vendor/ishop/core');                //Дериктория ядра
define("LIBS", ROOT . '/vendor/ishop/core/libs');           //Дериктория библиотек
define("CACHE", ROOT . '/tmp/cache');                       //Дериктория кэша
define("CONF", ROOT . '/config');                           //Дериктория конфиг файлов
define("LAYOUT", 'watches');                                //Выбраный шаблон

$app_path = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
$app_path = preg_replace("#[^/]+$#", '', $app_path);
$app_path = str_replace('/public/', '', $app_path);
define("PATH", $app_path);                                  //Корневая дериктория сайта
define("ADMIN", PATH . '/admin');                           //Корневая дериктория админки сайта

require_once ROOT . '/vendor/autoload.php';                 //автозагрузчик плагинов