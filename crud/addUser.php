<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Add User</h2>
    <form action="./createUser.php" method="post">
        <input type="name" placeholder="Your name" name="name" required>
        <br><br>
        <input type="email" placeholder="Your email" name="email" required>
        <br><br>
        <button type="submit" name="addUser123">Add user</button>
    </form>
    <br><br>
    <a href="./">
        <button>Home</button>
    </a>
</body>
</html>