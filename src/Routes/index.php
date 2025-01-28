<?php

use App\NewRouter;

$router = new NewRouter();

$router->get("/FYPWise-web/", "Pages/user-management-mgt/home-page.php");
$router->get("/FYPWise-web/about-us", "Pages/user-management-mgt/about-us-page.html");
$router->get("/FYPWise-web/login", "Pages/user-management-mgt/login-page.php");
$router->post("/FYPWise-web/login","Pages/user-management-mgt/login-page.php");
$router->get("/FYPWise-web/dashboard","Pages/user-management-mgt/user-dashboard-page.php");
$router->get("/FYPWise-web/administration", "Pages/administration/user-mgt-page.html");

$router->get("/FYPWise-web/test","Pages/project-proposal-mgt/new-proposals-management-page.php");

$router->dispatch();