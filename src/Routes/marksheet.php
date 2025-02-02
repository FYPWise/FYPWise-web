<?php

use App\Router;

$marksheetRoutes = new Router();

$marksheetRoutes->get("/FYPWise-web/marksheetpage","Pages/marksheet-mgt/marksheetpage.php");
$marksheetRoutes->post("/FYPWise-web/marksheetpage","Pages/marksheet-mgt/marksheetpage.php");
$marksheetRoutes->get("/FYPWise-web/criteriapage","Pages/marksheet-mgt/criteriascore.php");
$marksheetRoutes->get("/FYPWise-web/criteriapage/([a-zA-Z0-9_-]+)", function($marksheetID) {
    $_GET['marksheetID'] = $marksheetID; 
    include "src/Pages/marksheet-mgt/criteriascore.php";
});