<?php

use App\Router;

$meetingRoutes = new Router();

// Meeting
$meetingRoutes->get("/FYPWise-web/new-meeting","Pages/meeting-mgt/meeting-scheduler.php");
$meetingRoutes->post("/FYPWise-web/new-meeting", "Pages/meeting-mgt/meeting-scheduler.php");
$meetingRoutes->get("/FYPWise-web/view-meetings", "Pages/meeting-mgt/meeting-management.php");
$meetingRoutes->get("/FYPWise-web/view-meeting-details/([0-9]+)", function($meetingID) {
    echo "Meeting ID received: $meetingID";  // Debugging: To check if meetingID is captured correctly
    include "src/Pages/meeting-mgt/meeting-details.php";
});

// Meeting Logs
$meetingRoutes->get("/FYPWise-web/submit-meeting-log", "Pages/meeting-mgt/meeting-log-submission.php");
$meetingRoutes->post("/FYPWise-web/submit-meeting-log", "Pages/meeting-mgt/meeting-log-submission.php");
$meetingRoutes->get("/FYPWise-web/view-meeting-logs", "Pages/meeting-mgt/meeting-logs.php");
$meetingRoutes->get("/FYPWise-web/view-meeting-log-details/([0-9]+)", function($meeting_logID) {
    echo "Meeting Log ID received: $meeting_logID";  // Debugging: To check if meeting_logID is captured correctly
    include "src/Pages/meeting-mgt/meeting-log-details.php";
});
$meetingRoutes->post("/FYPWise-web/view-meeting-log-details/([0-9]+)", function($meeting_logID) {
    include "src/Pages/meeting-mgt/meeting-log-details.php";
});
$meetingRoutes->get("/FYPWise-web/book-presentation", "Pages/meeting-mgt/presentation-scheduler.php");
$meetingRoutes->post("/FYPWise-web/book-presentation", "Pages/meeting-mgt/presentation-scheduler.php");