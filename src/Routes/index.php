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

include "meeting.php";
$router->include($meetingRoutes);

$router->dispatch();