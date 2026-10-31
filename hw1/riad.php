<?php 
   
    // Electric bill calculation

     $unit = 250;

     if($unit <= 50){
        echo $unit * 3.50. "Tk"; 
     }else if($unit <= 150){
        echo 50 * 3.50 + (($unit - 50)* 4.00). "Tk";
     }else if($unit <= 250){
        echo 50 * 3.50 + 100 * 4.00 + (($unit - 150)* 5.20). "Tk";
     }else{
        echo 50 * 3.50 + 100 * 4.00 + 100 * 5.20 + (($unit - 250)* 6.50). "Tk";
     }


    //   calculator using switch 

    $num1 = 20;
    $num2 = 5;
    $operator = "+";

    switch ($operator) {
        case("+"):
            echo "\n".($num1 + $num2);
            break;
        case("-"):
            echo "\n".($num1 - $num2);
            break;
         case("*"):
            echo "\n".($num1 * $num2);
            break;
        case("/"):
            echo "\n".($num1 / $num2);
            break;
         default:
         echo "\n Invalid Operators";              
    }

    // a person is eligible to vote 

    $age = 20;

    if($age >= 18){
        echo "\n You are eligible to vote ";
    }else{
        echo "\n You are not eligible to vote";
    }


    // Check marriage eligibility by gender and age

    $gender = "Male";
    $age = 21;

    if($gender == "Male" && $age >= 21){
        echo "\n Eligible for Marriage";
    }else if($gender == "Female" && $age >= 18){
        echo "\n Eligible for Marriage";
    }else{
        echo "\n Not Eligible for Marriage";
    }

    // Check positive or negative number

    $num = "0";

    if($num > 0){
        echo "\n Positive Number";
    }else if($num < 0){
        echo "\n Negative Number";
    }else{
        echo "\n Zero";
    }


    // Check if number is odd or even

    $num = 10;

    if($num % 2 == 0){
        echo "\n Even";
    }else{
        echo "\n Odd";
    }


    // Check if data is integer or string

    $data = 25;

    if(is_int($data)){
        echo "\n Data is integer";
    }else if(is_string($data)){
        echo "\n Data is string ";
    }else{
        echo "\n Data is something else";
    }


  


?>