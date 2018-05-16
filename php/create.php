<?php
if ($_POST["create_title"] && $_POST["create_message"] && $_FILES["add_image"]["size"] != 0) {
    $file_name = $_FILES["add_image"]["name"];
    $image_path = "../uploads/" . $file_name;
    move_uploaded_file($_FILES["add_image"]["tmp_name"], $image_path);
    
    $username = "root";
    $password = "";

    $database = new PDO("mysql:host=localhost;dbname=message_bord;charset=UTF8;", $username, $password);
    
    $sql = "INSERT INTO messages (title, message, image_path) VALUES(:title, :message, :image_path)";
    $statement = $database->prepare($sql);
    $statement->bindParam(":title", $_POST["create_title"]);
    $statement->bindParam(":message", $_POST["create_message"]);
    $statement->bindParam(":image_path", $image_path);
    $statement->execute();
    $statement->null;
    $database = null;
} else if ($_POST["create_title"] && $_POST["create_message"]) {
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