<?php  
    // $url1 = "https://www.arian.com?city=Dhaka%20city&country=Bangladesh";

    echo $_GET["city"]?? "Get Empty City";
    echo "<br>";
    echo $_GET["country"] ?? "Get Empty Country";
    echo "<br>";
    echo $_POST["city"]?? "Post Empty City";
    echo "<br>";
    echo $_POST["country"] ?? "Post Empty Country";
    echo "<br>";
    echo $_REQUEST["city"] ?? "Post Empty City";
    echo "<br>";
    echo $_REQUEST["country"] ?? "Post Empty Country";
    echo "<br>";
    $_ENV["name"] = "Kuddus";
    echo $_ENV["name"];
?>

<form action="./l16-get-post-request.php" method="POST">
    <input type="text" placeholder="Your city" name="city">
    <input type="text" placeholder="Your country" name="country">
    <button type="submit">Submit</button>
</form>