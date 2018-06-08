<form action="uploadNewPicture.php" method="post" enctype="multipart/form-data">
<input type="file" name="datei"><br>
<input type="submit" value="Hochladen">
</form>

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
    //echo 'Bild erfolgreich hochgeladen: <a href="'.$new_path.'">'.$new_path.'</a>';

    ?>
