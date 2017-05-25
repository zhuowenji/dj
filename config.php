<?php

function connect()
{
    $mysqli = new mysqli('127.0.0.1', 'root', '123456', 'dajiang');
    //只能用函数来判断是否连接成功
    if (mysqli_connect_errno()) {
        return mysqli_connect_error();
    }

    return $mysqli;
}
