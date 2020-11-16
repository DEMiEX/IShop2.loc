<?php

namespace app\controllers;

use ishop\Cache;

class MainController extends AppController {

    #Метод обработки главной страницы
    public function indexAction(){
        $brands = \R::find('brand', 'LIMIT 3');                                 //вывод брендов
        $hits = \R::find('product', "hit = '1' AND status = '1' LIMIT 8");      //вывод хитовых
        $this->setMeta('Главная страница', 'Описание...', 'Ключевики...');
        $this->set(compact('brands', 'hits'));
    }

}