<?php  
    $email = "demo@example.com";
    if (preg_match('/^[\w.+-]+@[\w.-]+\.[a-zA-Z]{2,}$/', $email)) {
        echo "Email address is corect!";
    }

    echo "\n";

    $strongPassPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    $password = "Asif@321";
    if (preg_match($strongPassPattern, $password)) {
        echo "Strong password!";
    }
?>