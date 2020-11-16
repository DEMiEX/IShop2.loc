<?php

namespace ishop;

class Router{

    protected static $routes = [];
    protected static $route = [];

    #Метод добавления маршрута
    public static function add($regexp, $route = []){
        self::$routes[$regexp] = $route;
    }

    #Метод получения всех маршрутов
    public static function getRoutes(){
        return self::$routes;
    }

    #Метод получения маршрута
    public static function getRoute(){
        return self::$route;
    }

    #Метод перехода по маршруту
    public static function dispatch($url){
        $url = self::removeQueryString($url);
        if(self::matchRoute($url)){
            $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';
            if(class_exists($controller)){
                $controllerObject = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                if(method_exists($controllerObject, $action)){
                    $controllerObject->$action();
                    $controllerObject->getView();
                }else{
                    throw new \Exception("Метод $controller::$action не найден", 404);
                }
            }else{
                throw new \Exception("Контроллер $controller не найден", 404);
            }
        }else{
            throw new \Exception("Страница не найдена", 404);
        }
    }

    #Метод определения маршрута
    public static function matchRoute($url){
        foreach(self::$routes as $pattern => $route){
            if(preg_match("#{$pattern}#i", $url, $matches)){
                foreach($matches as $k => $v){
                    if(is_string($k)){
                        $route[$k] = $v;
                    }
                }
                if(empty($route['action'])){
                    $route['action'] = 'index';
                }
                if(!isset($route['prefix'])){
                    $route['prefix'] = '';
                }else{
                    $route['prefix'] .= '\\';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    #Метод приведения к CamelCase
    protected static function upperCamelCase($name){
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    #Метод приведения к camelCase
    protected static function lowerCamelCase($name){
        return lcfirst(self::upperCamelCase($name));
    }

    #Метод удаления строки запроса 
    protected static function removeQueryString($url){
        if($url){
            $params = explode('&', $url, 2);                    //разделение get параметров по & из строки запроса
            if(false === strpos($params[0], '=')){
                return rtrim($params[0], '/');
            }else{
                return '';
            }
        }
    }

}