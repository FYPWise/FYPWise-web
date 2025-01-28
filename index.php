<?php
session_start();
$_SESSION['logged-in'] = "true";

require './vendor/autoload.php';

require 'src/Routes/index.php';