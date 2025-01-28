<?php

namespace App;

class NewRouter{
     protected $routes = [];

     private function addRoute($route, $page, $method){
        $this->routes[$method][$route] = $page;
     }

     public function get($route, $page){
        $this->addRoute($route, $page,"GET");
     }

     public function post($route, $page){
        $this->addRoute($route, $page,"POST");
     }

     public function dispatch(){
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method =  $_SERVER['REQUEST_METHOD'];

         if (array_key_exists($uri, $this->routes[$method])) {
            $page = $this->routes[$method][$uri];

            include ($page);
         }else {
            include(__DIR__."/Pages/common-ui/404.php");
            echo($method);
            echo($uri);
            echo($this->routes[$method][$uri]);
        }
     }
}