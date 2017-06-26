<?php

// 检测是否登陆
function adminCheckLogin()
{
    if (!isset($_SESSION['username'])) {
        return header('Location: /houtai/login.php');
    }
}
