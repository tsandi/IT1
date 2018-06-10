<?php
$name = $_POST["name"];
$email = $_POST["email"];
$mes = $_POST["mes"];
$post = $_POST["post"];
$date = $_POST["date"] ;



if($post){

$write = fopen("com.txt", "a+");
$date = date("Y-m-d",strtotime($date));
fwrite($write, "<b><u>$name</u><b><u>$date</u></b><br><b><u>$email</u></b><br>$mes<br>");
fclose($write);

 $read = fopen("com.txt", "r+t");
 echo "All comments:";
 while(!feof($read)){
 echo fread($read, 1024);
    }
    fclose($read);
    }

    else {

    $read = fopen("com.txt", "r+t");
    echo "All comments:";
     while(!feof($read)){
     echo fread($read, 1024);
     }
     fclose($read);
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