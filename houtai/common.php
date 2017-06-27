<?php

session_start();

// 检测是否登陆
function adminCheckLogin()
{
    if (!isset($_SESSION['username'])) {
        return header('Location: /houtai/login.php');
    }
}

function LogOut()
{
    session_destroy();
    return header('Location: /houtai/login.php');
}
