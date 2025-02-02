<?php

use App\Router;

$project = new Router();

$project->get("/FYPWise-web/milestoneform","Pages/project-management-mgt/milestone-form.php");
$project->post("/FYPWise-web/milestoneform","Pages/project-management-mgt/milestone-form.php");
$project->get("/FYPWise-web/milestonesubmission",page: "Pages/project-management-mgt/milestone-submission.php");
$project->post("/FYPWise-web/milestonesubmission",page: "Pages/project-management-mgt/milestone-submission.php");
$project->get("/FYPWise-web/projectplanapproval","Pages/project-management-mgt/project-plan-approval.php");
$project->get("/FYPWise-web/projecttimelineplanning","Pages/project-management-mgt/project-timeline-planning.php");
$project->post("/FYPWise-web/projecttimelineplanning","Pages/project-management-mgt/project-timeline-planning.php");
$project->get("/FYPWise-web/projectmanagement","Pages/project-management-mgt/projectmanagement.php");
$project->get("/FYPWise-web/studentprojectassignment","Pages/project-management-mgt/student-project-assignment.php");
$project->post("/FYPWise-web/studentprojectassignment","Pages/project-management-mgt/student-project-assignment.php");
$project->get("/FYPWise-web/supervisorprojecttimeline","Pages/project-management-mgt/supervisor-project-timeline.php");

?>