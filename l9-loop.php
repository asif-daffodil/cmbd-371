<?php
    // while
    /*
    $sp = 0;
    $ep = 10;
    while($sp < $ep) {
        echo "$sp\n";
        $sp++;
    }
    

    for ($i=0; $i < 10; $i++) { 
        echo $i."\n";
    }

    

    $a = 20;
    do {
        echo $a."\n";
        $a++;
    }while($a < 10);

    $stdList = ["Riad", "Shahin", "Tamim"];

    foreach ($stdList as $key => $value) {
        echo "$key: $value \n";
    }

    */

    for ($j=0; $j < 10; $j++) { 
        if ($j === 6) {
            break;
        }else if($j === 4){
            continue;
        }
        echo $j."\n";
    }
    
?>