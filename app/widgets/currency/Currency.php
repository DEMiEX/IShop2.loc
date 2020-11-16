<?php

namespace app\widgets\currency;

use ishop\App;

class Currency{

    protected $tpl;
    protected $currencies;
    protected $currency;

    public function __construct(){
        $this->tpl = __DIR__ . '/currency_tpl/currency.php';            //выбор шаблона валюты
        $this->run();
    }

    #Метод запуска обработки валюты
    protected function run(){
        $this->currencies = App::$app->getProperty('currencies');
        $this->currency = App::$app->getProperty('currency');
        echo $this->getHtml();
    }

    #Метод получения всех валют и всех их св-в в виде массива из БД
    public static function getCurrencies(){
        return \R::getAssoc("SELECT code, title, symbol_left, symbol_right, value, base FROM currency ORDER BY base DESC");
    }

    #Метод получения текущей валюты
    public static function getCurrency($currencies){
        if(isset($_COOKIE['currency']) && array_key_exists($_COOKIE['currency'], $currencies)){
            $key = $_COOKIE['currency'];
        }else{
            $key = key($currencies);
        }
        $currency = $currencies[$key];
        $currency['code'] = $key;
        return $currency;
    }

    #Метод подготовки страницы пользователя
    protected function getHtml(){
        ob_start();
        require_once $this->tpl;
        return ob_get_clean();
    }

}