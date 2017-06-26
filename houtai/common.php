<?php

// 检测是否登陆
function adminCheckLogin()
{
    session_start();
    if (!isset($_SESSION['username'])) {
        return header('Location: /houtai/login.php');
    }
}
