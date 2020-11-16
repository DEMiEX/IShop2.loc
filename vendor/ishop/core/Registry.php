<?php

namespace ishop;

class Registry {

    use TSingletone;

    protected static $properties = [];                  //Массив сво-в

    #Метод записи сво-ва
    public function setProperty($name, $value){
        self::$properties[$name] = $value;
    }

    #Метод получения св-ва 
    public function getProperty($name){
        if(isset(self::$properties[$name])){
            return self::$properties[$name];
        }
        return null;
    }

    #Метод получения всех сво-в
    public function getProperties(){
        return self::$properties;
    }

}