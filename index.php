<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "people";
$status = "";

try {
    $scr = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
    $pdo = new PDO($scr, $dbUser, $dbPass);
} catch (PDOException $e) {
    echo "DB conextion failed" . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];

    if (empty($name)) $status = "Field name is required";

    $sql = "INSERT INTO names (Name) VALUES (:name)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name]);

    $status = "The name was save";
    $name = "";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Register names</title>
</head>

<body>
    <div class="box">

        <form class="form" action="" method="post">

            <label class="flabel" for="name">Name registration</label>
            <input class="finput" type="text" name="name" placeholder="Enter your name">
            <button class="fbutton" type="submit">Insert</button>

        </form>
    </div>
</body>

</html>