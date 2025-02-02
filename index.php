<?php
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
define('ROOT_DIR', __DIR__);
require './vendor/autoload.php';

require 'src/Routes/index.php';