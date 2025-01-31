<?php 

use App\Router;

$projectRoutes = new Router ();

$router->get("/FYPWise-web/milestoneform","Pages/project-management-mgt/milestone-form.php");
$router->get("/FYPWise-web/milestonesubmission","Pages/project-management-mgt/milestone-submission.php");
$router->get("/FYPWise-web/projectplanapproval","Pages/project-management-mgt/project-plan-approval.php");
$router->get("/FYPWise-web/projecttimelineplanning","Pages/project-management-mgt/project-timeline-planning.php");
$router->get("/FYPWise-web/projectmanagement","Pages/project-management-mgt/projectmanagement.php");
$router->get("/FYPWise-web/studentprojectassignment","Pages/project-management-mgt/student-project-assignment.php");
$router->get("/FYPWise-web/supervisorprojecttimeline","Pages/project-management-mgt/supervisor-project-timeline.php");