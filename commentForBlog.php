<?php





if(isset($_POST['post'])){
    $post = $_POST["post"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $mes = $_POST["mes"];

$write = fopen("com.txt", "a+");
$date = date("Y-m-d");
fwrite($write, "Name: <b><u>$name</u><b><u> Datum: $date</u></b><br><b><u>E-Mail: $email</u></b><br>Kommentar: $mes<br><br>");
fclose($write);

 $read = fopen("com.txt", "r+t");
 echo "All comments:";
    echo "<br> ";
 while(!feof($read)){
 echo fread($read, 1024);
    }
    fclose($read);
    }

    else {

    $read = fopen("com.txt", "r+t");
    echo "All comments:";
        echo "<br> ";
     while(!feof($read)){
     echo fread($read, 1024);

     }
     fclose($read);
     }
?>