<?php  
    require_once("./db.php");
    $selectQuery = "SELECT * FROM `users`";
    $result = $conn->query($selectQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>All User</h2>
    <table border="1" cellspacing="0" cellpadding="6">
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php  
            $i = 1;
            while($row = $result->fetch_object()) {
        ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $row->name ?></td>
                <td><?= $row->email ?></td>
                <td>
                    <a href="./editUser.php?id=<?= $row->id ?>">Edit</a>
                    <a href="./deleteUser.php?id=<?= $row->id ?>" onclick="return confirm('Are you sure you want to delete this user?');" >Delete</a>
                </td>
            </tr>
        <?php  
            }
        ?>
    </table>
    <br><br>
    <a href="./addUser.php">
        <button>Add user</button>
    </a>
</body>
</html>