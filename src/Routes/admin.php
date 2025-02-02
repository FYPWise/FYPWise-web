<?php

use App\Router;

$adminRoutes = new Router();

$adminRoutes->get("/FYPWise-web/new-user", "Pages/administration/new-user-page.php");
$adminRoutes->post("/FYPWise-web/new-user", "Pages/administration/new-user-page.php");
$adminRoutes->get("/FYPWise-web/manage-user", "Pages/administration/user-mgt-page.php");
$adminRoutes->get("/FYPWise-web/userlist", "Pages/administration/userlist.php");
$adminRoutes->get("/FYPWise-web/manage-announcements", "Pages/administration/announcements-mgt-page.php");
$adminRoutes->get("/FYPWise-web/new-announcement", "Pages/administration/new-announcement-page.php");

$adminRoutes->get("/FYPWise-web/moderator-management", "Pages/administration/moderator-project-mgt-page.php");
$adminRoutes->get("/FYPWise-web/assign-moderator", "Pages/administration/assign-moderator-page.php");
$adminRoutes->post("/FYPWise-web/assign-moderator", "Pages/administration/assign-moderator-page.php");