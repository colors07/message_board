<?php
if ($_POST["update_id"] && $_POST["update_title"] && $_POST["update_message"]) {
    $username = "root";
    $password = "";

    $database = new PDO("mysql:host=localhost;dbname=message_bord;charset=UTF8;", $username, $password);
    
    $sql = "UPDATE messages SET title = :title, message = :message WHERE id = :id";
    $statement = $database->prepare($sql);
    $statement->bindParam(":id", $_POST["update_id"]);
    $statement->bindParam(":title", $_POST["update_title"]);
    $statement->bindParam(":message", $_POST["update_message"]);
    $statement->execute();
    $statement->null;
    $database = null;
}
http_response_code(301);
header("Location: ../index.php");