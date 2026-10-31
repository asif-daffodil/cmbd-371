<?php
$n = 100;

if ($n < 20) {
    echo "\nn is smaller then 20";
} elseif ($n < 50) {
    echo "\nn is smaller then 50";
} else {
    echo "\nn is grater then 50";
}

$day = "Thuesday";
switch($day) {
    case("Friday"):
    echo "\nToday is weekend!";
    break;

    case("Saturday"):
    echo "\nToday is also weekend!";
    break;

    default:
    echo "\nToday is working day";

}

// ternary
$x = 5;
/* 
if($x < 10) {
    echo "X is smaller then 10";
}else {
    echo "x is grater then or equal to 10";
} 
*/

echo $x < 10 ? "\nX is smaller then 10":"\nX is smaller then 10";
