<?php
    function myFunc ($msg1 = "Hi", $msg2 = "Universe") {
        return $msg1." ".$msg2.".";
    }

    echo myFunc("Hello", "World");
    echo "\n";
    echo myFunc();
    echo "\n";
    echo myFunc("Assalamuoyalaikum");
    echo "\n";
    echo myFunc(msg2:"Everyone", msg1:"Goodbye");
    echo "\n";

    $otherFunc = function () {
        return "Other func";
    };

    echo $otherFunc();
    echo "\n";

    $otherArrFunc = fn() =>  "Hellow arrow function";
    echo $otherArrFunc();
    echo "\n";

    // factorial number
    function factorial ($n) {
        if($n <= 1) {
            return 1;
        }
        return $n * factorial($n - 1);
    }
    echo factorial(5);
    echo "\n";

    $name = "Asif";
    $greets = function() use(&$name) {
        return $name;
    };
    $name = "Abir";
    echo $greets();
    echo "\n";

    // callback function
    function mainFunc ($msg, $cb) {
        return $msg . ", " . $cb()."?";
    }

    echo mainFunc("Hi", function () {
        return "how are you";
    })
?>