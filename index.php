<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "people";
$status = "";
$query= "CREATE TABLE `people`.`names` ( `Name` VARCHAR(40) NOT NULL , `Id_name` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`Id_name`)) ENGINE = MyISAM; ";

$mysql = mysqli_connect($dbHost, $dbUser, $dbPass);

//create the data base if not exist
if (mysqli_select_db($mysql, $dbName)) {
    echo "Database exists";
} else {
    echo "Database does not exist";
    $db = new PDO($scr, $dbUser, $dbPass);
    $query = file_get_contents("shop.sql");

    $stmt = $db->prepare($query);

    if ($stmt->execute()){
        echo "Success creation";
    }else{ 
        echo "Fail creation";
    }
}
//connection to database
try {
    $scr = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
    $pdo = new PDO($scr, $dbUser, $dbPass);
} catch (PDOException $e) {
    echo "DB conextion failed" . $e->getMessage();
}


//save name into the database
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
<!-- This is a simple example in php to save names into a data base , using a form in html and styles in css -->
<!--Alejandro Fernandez Restrepo - Topicos en ingenieria de software - 07/2021 -->

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