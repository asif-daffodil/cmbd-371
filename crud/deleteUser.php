<?php  
    require_once("./db.php");
    require_once("./functions.php");

    if(isset($_GET['id'])) {
        $id = $conn->real_escape_string(safeData($_GET['id']));
        $deleteQuery = "DELETE FROM `users` WHERE `id` = '$id'";

        if($conn->query($deleteQuery)) {
            header("Location: ./");
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "No user ID provided.";
    }
?>