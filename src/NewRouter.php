<?php

namespace App;

class NewRouter {
   protected $routes = [];

   private function addRoute($route, $page, $method) {
      $this->routes[$method][] = ['route' => $route, 'page' => $page];
   }

   public function get($route, $page) {
      $this->addRoute($route, $page, "GET");
   }

   public function post($route, $page) {
      $this->addRoute($route, $page, "POST");
   }

   public function dispatch() {
      $uri = strtok($_SERVER['REQUEST_URI'], '?');  // Remove query string if present
      $method = $_SERVER['REQUEST_METHOD'];

      // Loop through all routes to match the current with dynamic parameters
      foreach ($this->routes[$method] as $route) {
         $pattern = '#^' . $route['route'] . '$#';

         if (preg_match($pattern, $uri, $matches)) {
               array_shift($matches); // Remove the full match from the matches array

               // If the route includes dynamic parameters, pass them to the page handler
               if (is_callable($route['page'])) {
                  call_user_func_array($route['page'], $matches);  // Pass parameters to function
               } else {
                  include($route['page']);  // For static pages
               }
               return;
         }
      }

      // If no route matched, show 404
      include(__DIR__ . "/Pages/common-ui/404.php");
   }
}