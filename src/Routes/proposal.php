<?php

use App\Router;

$proposalRoutes = new Router();

$proposalRoutes->get("/FYPWise-web/proposal","Pages/project-proposal-mgt/proposal-management-page.php");
$proposalRoutes->get("/FYPWise-web/proposal/([0-9]+)", function($proposalID) {
    // echo "Proposal ID received: $proposalID";  // Debugging: To check if proposalID is captured correctly
    include "src/Pages/project-proposal-mgt/proposal-details.php";
});
$proposalRoutes->post("/FYPWise-web/proposal/([0-9]+)", function($proposalID) {
    include "src/Pages/project-proposal-mgt/proposal-details.php";
});
$proposalRoutes->get("/FYPWise-web/submit-proposal", "Pages/project-proposal-mgt/proposal-submission-page.php");
$proposalRoutes->post("/FYPWise-web/submit-proposal", "Pages/project-proposal-mgt/proposal-submission-page.php");