<?php

namespace ishop;

trait TSingletone{

    private static $instance;               //сво-во образца

    //Метод создания образца
    public static function instance(){
        if(self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }

}