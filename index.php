<?php
session_start();
$_SESSION=[];

require 'vendor/autoload.php';
require 'html/header.html';

require 'src/navbar.php';
if (!isset($_SESSION['started_game'])) {
    require 'src/demo_info.php';
}

require 'html/footer.html';
