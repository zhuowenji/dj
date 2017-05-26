<?php

//此函数可以去掉空格，及换行。
function trimall($str)
{
    $qian = [' ', '\r\n', '\r', '\n', '\'', '\t', '　', '，'];
    $hou  = ['', '', '', '', '', '', '', ','];
    return str_replace($qian, $hou, $str);
}
