<?php

use App\NewRouter;

$router = new NewRouter();

// User
$router->get("/FYPWise-web/", "Pages/user-management/home-page.php");
$router->get("/FYPWise-web/about-us", "Pages/user-management/about-us-page.html");
$router->get("/FYPWise-web/login", "Pages/user-management/login-page.php");
$router->post("/FYPWise-web/login","Pages/user-management/login-page.php");
$router->get("/FYPWise-web/register","Pages/user-management/student-registration-page.php");
$router->get("/FYPWise-web/dashboard","Pages/user-management/user-dashboard-page.php");
$router->get("/FYPWise-web/profilemanagement","Pages/user-management/profile-mgt-page.php");

// Admin
$router->get("/FYPWise-web/new-user", "Pages/administration/new-user-page.php");
$router->get("/FYPWise-web/manage-user", "Pages/administration/user-mgt-page.php");
$router->get("/FYPWise-web/userlist", "Pages/administration/userlist.php");
$router->get("/FYPWise-web/viewUser", "Pages/administration/viewUser.php");

// Testing
$router->get("/FYPWise-web/test","Pages/common-ui/page-skeleton.php");
// Proposal Management
$router->get("/FYPWise-web/test","Pages/project-proposal-mgt/new-proposals-management-page.php");
$router->get("/FYPWise-web/proposal","Pages/project-proposal-mgt/proposal-management-page.php");
$router->get("/FYPWise-web/proposal/([0-9]+)", function($proposalID) {
    echo "Proposal ID received: $proposalID";  // Debugging: To check if proposalID is captured correctly
    include "src/Pages/project-proposal-mgt/proposal-status-management-page.php";  // Correct page
});

$router->dispatch();