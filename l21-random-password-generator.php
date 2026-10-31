<?php  
    $cAlfa = "ABCDEFGHIJKLMNOPQESTUVWXYZ";
    $sAlfa = "abcdefghijklmnopqustuvwxyz";
    $nums = "0123456789";
    $sChar = "!@#$%^&*()[]{}~";

    echo str_shuffle(substr(str_shuffle($cAlfa), 0, 2).substr(str_shuffle($sAlfa), 0, 2).substr(str_shuffle($nums), 0, 2).substr(str_shuffle($sChar), 0, 2));

    echo rand(100000, 999999);
    echo mt_rand(100000, 999999);
    echo random_int(100000, 999999);
    echo uniqid("cmbd", true);
    echo bin2hex(random_bytes(8));
?>