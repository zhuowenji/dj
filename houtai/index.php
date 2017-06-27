<?php
include '../config.php';
include '../function.php';

include 'base.php';

if (isset($_GET['logout']) && $_GET['logout'] == true) {
    LogOut();
}

include '../tmp/admin/head.php';
include '../tmp/admin/index_content.php';
