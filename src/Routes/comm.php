<?php

use App\Router;

$commRoutes = new Router();

$commRoutes->get("/FYPWise-web/Communication", "Pages/communication/comm-page.php");
$commRoutes->get("/FYPWise-web/openchat", "Pages/communication/openchat.php");
$commRoutes->get("/FYPWise-web/newMessage", "Pages/communication/newMessage.php");