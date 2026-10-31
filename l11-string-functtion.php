<?php  
    echo strlen("Hello World!")."\n";
    echo strtoupper("Hello World!")."\n";
    echo strtolower("HELLO WORLD!")."\n";
    echo ucfirst("hello world!")."\n";
    echo ucwords("hello world!")."\n";
    echo substr("hello world!", 0, 5)."\n";
    echo substr("hello world!", 6)."\n";
    echo substr("hello world!", -6)."\n";
    echo strpos("hello world!", "world")."\n";
    var_dump(strpos("hello world!", "universe"));
    var_dump(str_contains("hello world!", "hmmm")); 
    echo str_replace("world", "universe", "hello world!")."\n";
    echo trim("    hello   "); 

    $str = "Dhaka Rajshahi Khulna";
    $cities = explode(" ", $str);
    print_r($cities);

    $ctrArr = ["Bangladesh", "India", "Pakistan"];
    $ctrStr = implode(", ", $ctrArr);
    echo $ctrStr."\n";


?>