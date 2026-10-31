<?php
if (isset($_POST['up123'])) {
    $f_name = $_FILES["pic"]["name"];
    $temp_name = $_FILES["pic"]["tmp_name"];
    $ext_name = explode("/", $_FILES["pic"]["type"])[1];

    if (!$f_name) {
        $errFile = "<p style='color: red'>Please select a file!</p>";
    } elseif (!getimagesize($temp_name)) {
        $errFile = "<p style='color: red'>Invalid image file!</p>";
    } elseif (filesize($temp_name) > (2048 * 1024)) {
        $errFile = "<p style='color: red'>Image file size is very high!</p>";
    } else {
        $newFileName = date("MdYhmisa").rand(100000, 999999).".".$ext_name;
        $destination = "./uploads/".$newFileName;
        
        if(!move_uploaded_file($temp_name, $destination)) {
            $errFile = "<p style='color: red'>file upload fail!</p>";
        }else {
            echo "<div style='color: green'>Image uploaded suxxessfully!</div>";
        }
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="pic">
    <button type="submit" name="up123">Upload</button>
</form>
<?= $errFile ?? null ?>