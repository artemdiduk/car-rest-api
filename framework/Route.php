<?php

namespace Framework;

class Route
{
    private static $routes = [];
    public static function set($url, $dataAction, $method)
    {
        self::$routes[] = [
            "url" => $url,
            "controller" => $dataAction['controller'],
            "method" => $dataAction['method'],
            "REQUEST_METHOD" => $method,
        ];

        self::start();
    }

    public static function start()
    {
        foreach (self::$routes as $route) {
            if ($_SERVER['REQUEST_METHOD'] === $route['REQUEST_METHOD']) {
                $controller = $route['controller'];
                $method = $route['method'];
                if ((empty($_REQUEST['q']) && $url = "/")) {
                    $controller->$method();
                    die();
                   
                }
                self::entitiPageStatic($route['url'], $controller, $method);
                self::entitiPageActive($route['url'], $controller, $method);

            }
        }
        
    }

    public static function entitiPageStatic($url, $controller, $method)
    {

        if ($_REQUEST['q'] === $url) {
           
            $controller->$method();

            die();
        }
        if (strpos($url, "{")) {
            self::entitiPageActive($url, $controller, $method);
        }

    }

    public static function entitiPageActive($url, $controller, $method)
    {

        if (strpos($url, "{") !== false) {
            $urlReplace = preg_replace("/[{}]/u", '', $url);
            $urlExplode = explode('/', $urlReplace);
            $request = explode('/', $_REQUEST['q']);
            $urlAllCastom = substr($url, 0, 1) == "{" && substr($url, -1) == "}";
            $urlLastValueStatic = (count($urlExplode) == count($request)) && array_intersect($urlExplode, $request) && end($urlExplode) == end($request);
            $urlLastValueCastom = (count($urlExplode) == count($request)) && array_intersect($urlExplode, $request) && substr($url, -1) == "}";
            if($urlLastValueStatic) {
                self::renderPage(array_diff_assoc($request, $urlExplode), $controller, $method);
                die();
            }
            if($urlLastValueCastom) {
                self::renderPage(array_diff_assoc($request, $urlExplode), $controller, $method);
                die();
            }
            if ($urlAllCastom) {
                self::urlAllCastom(new \ReflectionMethod($controller, $method), $controller, $method, $request);
                die();
            }
          
        }
    }


    public static function renderPage($parmas, $controller, $method)
    {
        call_user_func_array([$controller, $method], $parmas);
        die();
    }

    public static function urlAllCastom($reflectionMethod, $controller, $method, $request)
    {
        if ($reflectionMethod->getNumberOfParameters() == count($request)) {
            call_user_func_array([$controller, $method], $request);
            die();
        }
    }
}