<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <title>MessageBoard</title>
    </head>
    
    <body>
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="../index.php">MessageBoard</a>
                <a href="./create_page.php">新規メッセージの投稿</a>
            </div>
        </nav>
        
        <div class="container">
            <?php
                if (isset($_GET["id"])) {
                    print "<h3>id = " . $_GET["id"] . " のメッセージ詳細ページ</h3>";
                    
                    $username = "root";
                    $password = "";
                    
                    $database = new PDO("mysql:host=localhost;dbname=message_board;charset=UTF8;", $username, $password);
                    
                    $sql = "SELECT * FROM messages WHERE id = :id";
                    $statement = $database->prepare($sql);
                    $statement->bindParam(':id', $_GET["id"]);
                    $statement->execute();
                    $record = $statement->fetch(PDO::FETCH_ASSOC);
                    
                    $statement = null;
                    $database = null;
                    
                    $id = $record["id"];
                    $title = $record["title"];
                    $message = $record["message"];
                    
                    print "<div class=\"row\"><div class=\"col-md-2\"><h6>id</h6></div><div class=\"col-md-10\">";
                    print "<div class=\"id\">" . htmlspecialchars($id, ENT_QUOTES, "UTF-8") . "</div>";
                    print "</div></div>";
                    
                    print "<div class=\"row\"><div class=\"col-md-2\"><h6>title</h6></div><div class=\"col-md-10\">";
                    print "<div class=\"title\">" . htmlspecialchars($title, ENT_QUOTES, "UTF-8") . "</div>";
                    print "</div></div>";
                    
                    print "<div class=\"row\"><div class=\"col-md-2\"><h6>message</h6></div><div class=\"col-md-10\">";
                    print "<div class=\"message\">" . htmlspecialchars($message, ENT_QUOTES, "UTF-8") . "</div>";
                    print "</div></div>";
                    
                    print "<a href=\"./update_page.php?id=" . $id . "\">このメッセージを編集</a><br>";
                    
                    print "<form action=\"../php/delete.php\" method=\"POST\"><input type=\"hidden\" name=\"delete_id\" value=\"" . $id . "\"><input type=\"submit\" name=\"submit_delete\" value=\"削除\"></form>";
                }
            ?>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>
