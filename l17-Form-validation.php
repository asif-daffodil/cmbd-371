<?php
$allowedGender = ["male", "female"];
$allowedSkills = ["html", "css", "js", "php"];

function safe_data ($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripcslashes($data);
    return $data;
}

if (isset($_POST['regForm123'])) {
    $name = safe_data($_POST['name']);
    $email = safe_data($_POST['email']);
    $gender = isset($_POST['gender']) ? safe_data($_POST['gender']): null;
    $skills = $_POST['skill'] ?? null;
    $password = safe_data($_POST['password']);
    $conform_password = safe_data($_POST['conform_password']);

    if(isset($skills) && count($skills) > 0) {
        $pureSkills = [];
        foreach ($skills as $skill) {
            array_push($pureSkills, safe_data($skill));
        }
        $skills = $pureSkills;
    }

    if (empty($name)) {
        $errName = "<span style='color: red'>Please write your name</span>";
    } elseif (!preg_match("/^[A-Za-z.\- ]*$/", $name)) {
        $errName = "<span style='color: red'>Ivalid name</span>";
    } else {
        $crrName = $name;
    }

    if (empty($email)) {
        $errEmail = "<span style='color: red'>Please write email address</span>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errEmail = "<span style='color: red'>Ivalid email address</span>";
    } else {
        $crrEmail = $email;
    }

    if (empty($gender)) {
        $errGender = "<span style='color: red'>Please select your gender</span>";
    } elseif (!in_array($gender, $allowedGender) && !in_array($gender, $allowedGender) ) {
        $errGender = "<span style='color: red'>Ivalid gender</span>";
    } else {
        $crrGender = $gender;
    }

    if (empty($skills)) {
        $errSkill = "<span style='color: red'>Please select your skills</span>";
    }else {
        foreach ($skills as $skill) {
            if (!in_array($skill, $allowedSkills)) {
                $errSkill = "<span style='color: red'>Invalid skill</span>";
                break;
            }
        }
        if(!isset($errSkill)) {
            $crrSkills = $skills;
        }
    }

    if (empty($password)) {
        $errPassword = "<span style='color: red'>Please write your password</span>";
    } elseif (strlen($password) < 6) {
        $errPassword = "<span style='color: red'>Please provide an strong password</span>";
    } else {
        $crrPassword = $password;
    }

    if (empty($conform_password)) {
        $errConPassword = "<span style='color: red'>Please write your conform password</span>";
    } elseif (strlen($conform_password) < 6) {
        $errConPassword = "<span style='color: red'>Please provide an strong confirm password</span>";
    } elseif ($conform_password !== $password) {
        $errConPassword = "<span style='color: red'>Password didn't match</span>";
    } else {
        $crrConPassword = $conform_password;
    }

    if(isset($crrName) && isset($crrEmail) && isset($crrGender) && isset($crrSkills) && isset($crrPassword) && isset($crrConPassword)) {
        $success = "
            <div style='color: green'>
                <b>User name : </b> $crrName <br />
                <b>User email : </b> $crrEmail <br />
                <b>User gender : </b> $crrGender <br />
                <b>User skills : </b>". implode(", ", $crrSkills) ."<br />
                <b>User password : </b>". password_hash($crrPassword, PASSWORD_DEFAULT) ."<br />
            </div>
        ";
        $name = $email = $gender = $skills = $password = $conform_password = null;
    }
}
?>

<form action="" method="post">
    <input type="text" placeholder="Your name" name="name" value="<?= $name ?? null ?>">
    <?= $errName ?? null ?>
    <br><br>
    <input type="text" placeholder="Your email" name="email" value="<?= $email ?? null ?>">
    <?= $errEmail ?? null ?>
    <br><br>
    <label for="">Gender : </label>
    <label for="male">
        <input type="radio" id="male" name="gender" value="male" <?= isset($gender) && $gender === "male" ? "checked":null  ?> >Male
    </label>
    <label for="female">
        <input type="radio" id="female" name="gender" value="female" <?= isset($gender) && $gender === "female" ? "checked":null  ?>>Female
    </label>
    <?= $errGender ?? null ?>
    <br><br>
    <label for="">Skills : </label>
    <label for="html">
        <input type="checkbox" name="skill[]" id="html" value="html" <?= isset($skills) && count($skills) > 0 && in_array("html", $skills) ? "checked":null  ?>>HTML
    </label>
    <label for="css">
        <input type="checkbox" name="skill[]" id="css" value="css" <?= isset($skills) && count($skills) > 0 && in_array("css", $skills) ? "checked":null  ?>>CSS
    </label>
    <label for="js">
        <input type="checkbox" name="skill[]" id="js" value="js" <?= isset($skills) && count($skills) > 0 && in_array("js", $skills) ? "checked":null  ?>>JS
    </label>
    <label for="php">
        <input type="checkbox" name="skill[]" id="php" value="php" <?= isset($skills) && count($skills) > 0 && in_array("php", $skills) ? "checked":null  ?>>PHP
    </label>
    <?= $errSkill ?? null ?>
    <br><br>
    <input type="password" placeholder="Your password" name="password" value="<?= $password ?? null ?>">
    <?= $errPassword ?? null ?>
    <br><br>
    <input type="password" placeholder="Confirm password" name="conform_password" value="<?= $conform_password ?? null ?>">
    <?= $errConPassword ?? null ?>
    <br><br>
    <button type="submit" name="regForm123">Submit</button>
</form>
<?= $success ?? null ?>