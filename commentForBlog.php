<?php





if(isset($_POST['post'])){
    $post = $_POST["post"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $mes = $_POST["mes"];
    $blogId = $_GET['page'];

$write = fopen("$blogId.txt", "a+");
$date = date("Y-m-d");
fwrite($write, "Name: <b><u>$name</u><b><u> Datum: $date</u></b><br><b><u>E-Mail: $email</u></b><br>Kommentar: $mes<br><br>");
fclose($write);

 $read = fopen("$blogId.txt", "r+t");
 echo "All comments:";
    echo "<br> ";
 while(!feof($read)){
 echo fread($read, 1024);
    }
    fclose($read);
    }

    else {

    $read = fopen("$blogId.txt", "r+t");
    echo "All comments:";
        echo "<br> ";
     while(!feof($read)){
     echo fread($read, 1024);

     }
     fclose($read);
     }
?>