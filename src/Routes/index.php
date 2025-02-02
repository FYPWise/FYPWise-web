<?php

use App\Router;

$router = new Router();

// User
include "user.php";
$router->include($userRoutes);

// Admin
include "admin.php";
$router->include($adminRoutes);

// Proposal Management
include "proposal.php";
$router->include($proposalRoutes);

//marksheet management
include "marksheet.php";
$router->include($marksheetRoutes);

//communication management
include "comm.php";
$router->include($commRoutes);

include "meeting.php";
$router->include($meetingRoutes);

include "final.php";
$router->include($final);

include "project.php";
$router->include($final);
//project management
$router->get("/FYPWise-web/milestoneform","Pages/project-management-mgt/milestone-form.php");
$router->post("/FYPWise-web/milestoneform","Pages/project-management-mgt/milestone-form.php");
$router->get("/FYPWise-web/milestonesubmission",page: "Pages/project-management-mgt/milestone-submission.php");
$router->post("/FYPWise-web/milestonesubmission",page: "Pages/project-management-mgt/milestone-submission.php");
$router->get("/FYPWise-web/projectplanapproval","Pages/project-management-mgt/project-plan-approval.php");
$router->get("/FYPWise-web/projecttimelineplanning","Pages/project-management-mgt/project-timeline-planning.php");
$router->get("/FYPWise-web/projectmanagement","Pages/project-management-mgt/projectmanagement.php");
$router->get("/FYPWise-web/studentprojectassignment","Pages/project-management-mgt/student-project-assignment.php");
$router->post("/FYPWise-web/studentprojectassignment","Pages/project-management-mgt/student-project-assignment.php");
$router->get("/FYPWise-web/supervisorprojecttimeline","Pages/project-management-mgt/supervisor-project-timeline.php");

$router->dispatch();