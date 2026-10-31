<?php
// 1. Electric bill calculation
$units = 280;
$bill = 0;

if ($units <= 50) {
    $bill = $units * 3.50;
} elseif ($units <= 150) {
    $bill = (50 * 3.50) + (($units - 50) * 4.00);
} elseif ($units <= 250) {
    $bill = (50 * 3.50) + (100 * 4.00) + (($units - 150) * 5.20);
} else {
    $bill = (50 * 3.50) + (100 * 4.00) + (100 * 5.20) + (($units - 250) * 6.50);
}

echo "Total Electricity Bill: " . $bill . " TK<br><br>";

// 2. PHP calculator using switch case
$num1 = 20;
$num2 = 5;
$operator = "*";

switch ($operator) {
    case "+":
        echo "Result: " . ($num1 + $num2) . "<br><br>";
        break;

    case "-":
        echo "Result: " . ($num1 - $num2) . "<br><br>";
        break;

    case "*":
        echo "Result: " . ($num1 * $num2) . "<br><br>";
        break;

    case "/":
        if ($num2 != 0) {
            echo "Result: " . ($num1 / $num2) . "<br><br>";
        } else {
            echo "Cannot divide by zero<br><br>";
        }
        break;

    default:
        echo "Invalid operator<br><br>";
}

// 3. Check if a person is eligible to vote by age
$age = 20;

if ($age >= 18) {
    echo "You are eligible to vote.<br><br>";
} else {
    echo "You are not eligible to vote.<br><br>";
}

// 4. Check if a person is eligible for marriage in BD by gender
$gender = "male";
$age = 20;

if (($gender == "male" && $age >= 21) || ($gender == "female" && $age >= 18)) {
    echo "You are eligible for marriage.<br><br>";
} else {
    echo "You are not eligible for marriage.<br><br>";
}

// 5. Check if number is positive or negative
$num = -10;

if ($num > 0) {
    echo "Positive number<br><br>";
} elseif ($num < 0) {
    echo "Negative number<br><br>";
} else {
    echo "Zero<br><br>";
}

// 6. Check if number is odd or even
$num = 15;

if ($num % 2 == 0) {
    echo "Even number<br><br>";
} else {
    echo "Odd number<br><br>";
}

// 7. Check if data is integer or string
$data = "100";

if (is_int($data)) {
    echo "The data is an integer.<br><br>";
} elseif (is_string($data)) {
    echo "The data is a string.<br><br>";
} else {
    echo "The data is neither integer nor string.<br><br>";
}
?>