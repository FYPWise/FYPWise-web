<?php

use App\Router;

$meetingRoutes = new Router();

$meetingRoutes->get("/FYPWise-web/new-meeting","Pages/meeting-mgt/meeting-scheduler.php");
$meetingRoutes->post("/FYPWise-web/new-meeting", "Pages/meeting-mgt/meeting-scheduler.php");
$meetingRoutes->get("/FYPWise-web/view-meetings", "Pages/meeting-mgt/meeting-management.php");