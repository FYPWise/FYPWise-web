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


//final management
include "final.php";
$router->include($final);

//project management
include "project.php";
$router->include($project);

$router->dispatch();