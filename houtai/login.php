<?php
include '../config.php';
include '../function.php';

$msg = '';
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $mysqli = connect();
    $sql    = "select username from admin where username = '" . $username . "' and password = '" . $password . "'";

    $res = $mysqli->query($sql);
    if ($mysqli->affected_rows) {
        $user = $res->fetch_array();

        session_start();
        $_SESSION['username'] = $user['username'];

        header('Location: /houtai');
    }

    $msg = '用户名或者密码错误';
}

include '../tmp/admin/head.php';
include '../tmp/admin/login.php';
