<?php

use App\Router;

$userRoutes = new Router();

// User
$userRoutes->get("/FYPWise-web/", "Pages/user-management/home-page.php");
$userRoutes->get("/FYPWise-web/about-us", "Pages/user-management/about-us-page.php");
$userRoutes->get("/FYPWise-web/login", "Pages/user-management/login-page.php");
$userRoutes->post("/FYPWise-web/login","Pages/user-management/login-page.php");
$userRoutes->get("/FYPWise-web/register","Pages/user-management/student-registration-page.php");
$userRoutes->post("/FYPWise-web/register","Pages/user-management/student-registration-page.php");
$userRoutes->get("/FYPWise-web/dashboard","Pages/user-management/user-dashboard-page.php");
$userRoutes->post("/FYPWise-web/dashboard","Pages/user-management/user-dashboard-page.php");
$userRoutes->get("/FYPWise-web/profilemanagement","Pages/user-management/profile-mgt-page.php");
$userRoutes->get("/FYPWise-web/profileedit","Pages/user-management/profile-edit-page.php");
$userRoutes->post("/FYPWise-web/profileedit","Pages/user-management/profile-edit-page.php");
?>
