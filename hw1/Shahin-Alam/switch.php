<?php

$num1 = 20;
$num2 = 5;
$operator = "*";

switch ($operator) {

    case "+":
        echo "Result: " . ($num1 + $num2);
        break;

    case "-":
        echo "Result: " . ($num1 - $num2);
        break;

    case "*":
        echo "Result: " . ($num1 * $num2);
        break;

    case "/":
        if ($num2 != 0) {
            echo "Result: " . ($num1 / $num2);
        } else {
            echo "Cannot divide by zero";
        }
        break;

    default:
        echo "Invalid operator";
}

?>