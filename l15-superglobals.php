<?php  
    $demoData = "Demo Data";
    function demoFunc () {
        return $GLOBALS['demoData'];
    }

    echo demoFunc();

    echo "\n";

    // print_r($_SERVER);
    // var_dump($_SERVER);
    echo basename($_SERVER['PHP_SELF']);
    echo $_SERVER["REQUEST_METHOD"];

?>