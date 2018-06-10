

<div id="blogDisply">
    <?php
    if ( $_GET['page']){
        $blogId = $_GET['page'];
        //echo $blogId;
        $blog = file_get_contents('BlogDataBase.JSON');
        $allBlogs = json_decode($blog, true);
        foreach($allBlogs as $value){
            $newID = $value['BlogID'];
            if($value['BlogID'] == $blogId){
                echo "<h3>";
                echo $value['Title'];
                echo "</h3>";
                echo "<h5>";
                echo $value['Date'];
                echo "</h5>";
                echo "<p>";
                echo $value['Content'];
                echo "<p>";
            }
        }
    }
    ?>

    <html>

    <form action="" method="POST">
        <h1> Leave a comment<br> </h1>
        <label> Name: <br><input type="text" name="name"><br></label>
        <label> Email: <br><input type="text" name="email"><br></label>
        <label> Comment: <br><textarea colls="35" rows="5"
                                       name="mes"></textarea><br></label>
        <input type="submit" name="post" value="Post">
    </form>
    </html>
    <?php
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mes'])  && isset($_POST['post'])  ) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $mes = $_POST["mes"];
        $post = $_POST["post"];
    }



    if(isset($_POST['post'])){

        $write = fopen("com.txt", "a+");
        $date = date("Y-m-d");
        fwrite($write, "Name:<b><u>$name</u>  Datum:<b><u>$date</u></b><br>E-Mail:<b><u>$email</u></b><br>Kommentar: <br> $mes<br>");
        fclose($write);

        $read = fopen("com.txt", "r+t");
        while(!feof($read)){
            echo fread($read, 1024);
        }
        fclose($read);
    }

    else {

        $read = fopen("com.txt", "r+t");
        while(!feof($read) == true){
            echo fread($read, 1024);
        }
        fclose($read);
    }
    ?>
</div>

<form method="get" action="/index.php">
    <button type="submit">Zurück</button>
</form>
