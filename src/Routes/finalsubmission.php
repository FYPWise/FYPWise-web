<?php

use App\Router;

$finalsubmissionRoutes = new Router();

$router->get("/FYPWise-web/finalsubmission","Pages/final-report-submission-mgt/final-report-submission.php");
$router->get("/FYPWise-web/finalsubmission/([0-9]+)", function($projectID) {
    include "src/Pages/final-report-submission-mgt/final-report-submission.php";
});