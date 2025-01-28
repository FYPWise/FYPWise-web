<?php

use App\NewRouter;

$router = new NewRouter();

$router->get("/testb/", "Pages/user-management-mgt/home-page.php");
$router->get("/testb/about-us", "Pages/user-management-mgt/about-us-page.html");
$router->get("/testb/login", "Pages/user-management-mgt/login-page.php");
$router->post("/testb/login","Pages/user-management-mgt/login-page.php");
$router->get("/testb/dashboard","Pages/user-management-mgt/user-dashboard-page.php");
$router->get("/testb/administration", "Pages/administration/user-mgt-page.html");

$router->get("/testb/test","Pages/project-proposal-mgt/new-proposals-management-page.php");

$router->dispatch();