<?php
if ($_POST["create_title"] && $_POST["create_message"]) {
    $username = "root";
    $password = "";

    $database = new PDO("mysql:host=localhost;dbname=message_bord;charset=UTF8;", $username, $password);

    $sql = "INSERT INTO messages (title, message) VALUES(:title, :message)";
    $statement = $database->prepare($sql);
    $statement->bindParam(":title", $_POST["create_title"]);
    $statement->bindParam(":message", $_POST["create_message"]);
    $statement->execute();
    $statement->null;
    $database = null;
}
http_response_code(301);
header("Location: ../index.php");