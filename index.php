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
                <a class="navbar-brand" href="./index.php">MessageBoard</a>
                <a href="./messages/create_page.php">新規メッセージの投稿</a>
            </div>
        </nav>
        
        <div class="container">
            <h3>メッセージ一覧</h3>
            
            <div class="row">
                <div class="col-md-1"><h6>id</h6></div>
                <div class="col-md-3"><h6>title</h6></div>
                <div class="col-md-8"><h6>message</h6></div>
            </div>
            
            <?php
                $username = "root";
                $password = "";
                
                $database = new PDO("mysql:host=localhost;dbname=message_bord;charset=UTF8;", $username, $password);
                
                $sql = "SELECT * FROM messages ORDER BY created_at DESC";
                $statement = $database->query($sql);
                $records = $statement->fetchAll();
                
                $statement = null;
                $database = null;
                
                if ($records) {
                    foreach ($records as $record) {
                        print "<div class=\"row\">";
                        
                        $id = $record["id"];
                        $title = $record["title"];
                        $message = $record["message"];
                        $image_path = $record["image_path"];
                        
                        print "<div class=\"col-md-1\">" . "<a href=\"./messages/message.php?id=$id\">" . htmlspecialchars($id, ENT_QUOTES, "UTF-8") . "</a>" . "</div>";
                        print "<div class=\"col-md-3\">" . htmlspecialchars($title, ENT_QUOTES, "UTF-8") . "</div>";
                        print "<div class=\"col-md-7\">" . htmlspecialchars($message, ENT_QUOTES, "UTF-8") . "</div>";
                        print "<div class=\"col-md-1\">";
                        if (isset($image_path)) {
                            print "<a href=\"./php/$image_path\">画像</a>";
                        }
                        print "</div>";
                        
                        print "</div>";
                    }
                }
            ?>
            
            <a href="./messages/create_page.php">新規メッセージの投稿</a>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>