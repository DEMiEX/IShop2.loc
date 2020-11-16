<?php

namespace ishop;

class Db{

    use TSingletone;

    #Конструктор подключения к базе данных
    protected function __construct(){
        $db = require_once CONF . '/config_db.php';                     //Подключение конфиг файла    
        class_alias('\RedBeanPHP\R','\R');                              //Подключение использование краткого вызова        
        \R::setup($db['dsn'], $db['user'], $db['pass']);                //Установка подключения к БД
        if( !\R::testConnection() ){
            throw new \Exception("Нет соединения с БД", 500);
        }
        \R::freeze(true);                                               //Запрет изменение БД в интерактивном режиме
        if(DEBUG){
            \R::debug(true, 1);                                         //Включение режима отладки БД        
        }

        \R::ext('xdispense', function($type){
            return \R::getRedBean()->dispense( $type );
        });
    }

}