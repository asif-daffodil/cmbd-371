<?php

$gender = "male";
$age = 22;

if ($gender == "male") {

    if ($age >= 21) {
        echo "Eligible for marriage.";
    } else {
        echo "Not eligible for marriage.";
    }

} elseif ($gender == "female") {

    if ($age >= 18) {
        echo "Eligible for marriage.";
    } else {
        echo "Not eligible for marriage.";
    }

} else {
    echo "Invalid gender.";
}

?>