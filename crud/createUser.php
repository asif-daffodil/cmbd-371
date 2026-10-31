<?php  
    require_once("./db.php");
    require_once("./functions.php");

    if(isset($_POST['addUser123'])) {
        $name = $conn->real_escape_string(safeData($_POST['name']));
        $email = $conn->real_escape_string(safeData($_POST['email']));

        $query = "INSERT INTO `users` (`name`, `email`) VALUES ('$name', '$email')";

        if($conn->query($query)) {
            header("Location: ./");
        } else {
            echo "Error: " . $conn->error;
        }
    }
?>