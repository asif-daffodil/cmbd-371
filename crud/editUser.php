<?php  
    require_once("./db.php");
    require_once("./functions.php");

    if(isset($_GET['id'])) {
        $id = $conn->real_escape_string(safeData($_GET['id']));
        $selectQuery = "SELECT * FROM `users` WHERE `id` = '$id'";
        $result = $conn->query($selectQuery);

        if($result->num_rows > 0) {
            $user = $result->fetch_object();
        } else {
            echo "User not found.";
            exit;
        }
    } else {
        echo "No user ID provided.";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Edit User</h2>
    <form action="updateUser.php" method="post">
        <!-- Add input fields for user data here -->
        <input type="hidden" name="id" value="<?= $user->id ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?= $user->name ?>">
        <br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= $user->email ?>">
        <br><br>
        <input type="submit" value="Update User">
    </form>
</body>
</html>