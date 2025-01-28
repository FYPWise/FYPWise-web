<?php

use App\NewRouter;

$router = new NewRouter();

// User
$router->get("/FYPWise-web/", "Pages/user-management/home-page.php");
$router->get("/FYPWise-web/about-us", "Pages/user-management/about-us-page.html");
$router->get("/FYPWise-web/login", "Pages/user-management/login-page.php");
$router->post("/FYPWise-web/login","Pages/user-management/login-page.php");
$router->get("/FYPWise-web/register","Pages/user-management/student-registration-page.php");
$router->get("/FYPWise-web/dashboard","Pages/user-management/user-dashboard-page.php");
$router->get("/FYPWise-web/profilemanagement","Pages/user-management/profile-mgt-page.php");

// Admin
$router->get("/FYPWise-web/administration", "Pages/administration/user-mgt-page.html");

$router->get("/FYPWise-web/test","Pages/project-proposal-mgt/new-proposals-management-page.php");

$router->dispatch();