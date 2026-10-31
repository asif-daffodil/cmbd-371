<?php  
    require_once("./db.php");
    require_once("./functions.php");

    if(isset($_POST['id'])) {
        $id = $conn->real_escape_string(safeData($_POST['id']));
        $name = $conn->real_escape_string(safeData($_POST['name']));
        $email = $conn->real_escape_string(safeData($_POST['email']));

        $updateQuery = "UPDATE `users` SET `name` = '$name', `email` = '$email' WHERE `id` = '$id'";

        if($conn->query($updateQuery)) {
            header("Location: ./");
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "No user ID provided.";
    }
?>