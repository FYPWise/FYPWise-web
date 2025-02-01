<?php

use App\Router;

$meetingRoutes = new Router();

$meetingRoutes->get("/FYPWise-web/new-meeting","Pages/meeting-mgt/meeting-scheduler.php");