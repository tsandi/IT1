</html>

<script>
function deleteImage(&datei)
{
    var file_path = <?php echo dirname(__FILE__) . '/uploads/'?>+file_name;
        file_path.remove();
}
</script>

<?php
// Bilder ausgabe
$bilderliste = array();
$verzeichnis = 'uploads/';
$handle = openDir($verzeichnis);
while ($datei = readDir($handle)) {
    $verzeichnis_datei = $verzeichnis . $datei;
    if ($datei != "." && $datei != ".." && !is_dir($datei)) {
        if (strstr($datei, ".gif") || strstr($datei, ".png") || strstr($datei, ".jpeg") ||strstr($datei, ".JPG") ||strstr($datei, ".jpg")) {
            $info = getimagesize($verzeichnis_datei);
            array_push($bilderliste, array(filemtime($verzeichnis_datei) , $verzeichnis_datei , $info[0] , $info[1]));
        }
    }
}
closeDir($handle);

rsort($bilderliste);

echo <<<EOT
<table border="1">
<tr>
<th>Bild</th> <th>Name</th> <th>Datum</th>
</tr>
EOT;

foreach ($bilderliste as $zaehler => $element) {
    echo "<tr>";
    echo  "<th ><img src=\"" . $bilderliste[$zaehler][1] . "\" width=\"20%" . $bilderliste[$zaehler][2] . "\" height=\"20%" . $bilderliste[$zaehler][3] . "\" alt=\"\"></th>";
    $datei = str_replace($verzeichnis, "", $bilderliste[$zaehler][1]);
    echo "<td>" . $datei . "</td>";
    //echo "<td>" . date("d.m.Y H:i", $bilderliste[$zaehler][0]) . "</td>";
    echo "<td> <a href='uploadNewPicture.php' onClick='return confirm(\"Wirklich l&ouml;schen?\")'>l&ouml;schen?</a></td>";  // Löschen mit Bestätigung
    echo "</tr>";
    
}
echo "</table>";
    
    
    
    echo "++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++";
?>


<form action="uploadNewPicture.php" method="post" enctype="multipart/form-data">
<input type="file" name="datei"><br>
<input type="submit" value="Upload">
</form>
<button onclick="goBack()">Zurück</button>

<script>
    function goBack() {
        window.history.back();
    }
</script>

<meta http-equiv="refresh" >

<?php
    //Überprüfung dass das Bild keine Fehler enthält
    if(function_exists('exif_imagetype')) {
        $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
        $detected_type = exif_imagetype($_FILES['datei']['tmp_name']);
        if(!in_array($detected_type, $allowed_types)) {
            die("Nur der Upload von Bilddateien ist gestattet");
        }
    }
    
    $upload_folder = 'uploads/'; //Das Upload-Verzeichnis
    $filename = pathinfo($_FILES['datei']['name'], PATHINFO_FILENAME);
    $extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));
    
    $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');//Überprüfung der Dateiendung
    if(!in_array($extension, $allowed_extensions)) {
        die("Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt");
    }
    
    //Überprüfung der Dateigröße
    $max_size = 2000*1024; //2MB
    if($_FILES['datei']['size'] > $max_size) {
        die("Bitte keine Dateien größer 2MB hochladen");
    }
    
    //Pfad zum Upload
    $new_path = $upload_folder.$filename.'.'.$extension;
    
    if(file_exists($new_path)) { //Falls Datei existiert, hänge eine Zahl an den Dateinamen
        $id = 1;
        do {
            $new_path = $upload_folder.$filename.'_'.$id.'.'.$extension;
            $id++;
        } while(file_exists($new_path));
    }
    
    move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);
    echo '...Bild wird hochgeladen'; //<a href="'.$new_path.'">'.$new_path.'</a>';
    header("Refresh:2");
    
    ?>
