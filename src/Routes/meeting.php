<?php

use App\Router;

$meetingRoutes = new Router();

$meetingRoutes->get("/FYPWise-web/new-meeting","Pages/meeting-mgt/meeting-scheduler.php");
$meetingRoutes->post("/FYPWise-web/new-meeting", "Pages/meeting-mgt/meeting-scheduler.php");
$meetingRoutes->get("/FYPWise-web/view-meetings", "Pages/meeting-mgt/meeting-management.php");
$meetingRoutes->get("/FYPWise-web/view-meeting-details/([0-9]+)", function($meetingID) {
    echo "Meeting ID received: $meetingID";  // Debugging: To check if meetingID is captured correctly
    include "src/Pages/meeting-mgt/meeting-details.php";
});