<?php
if ($_POST["delete_id"]) {
    $username = "root";
    $password = "";

    $database = new PDO("mysql:host=localhost;dbname=message_bord;charset=UTF8;", $username, $password);
    
    $sql = "DELETE FROM messages WHERE id = :id";
    $statement = $database->prepare($sql);
    $statement->bindParam(":id", $_POST["delete_id"]);
    $statement->execute();
    $statement->null;
    $database = null;
}
http_response_code(301);
header("Location: ../index.php");