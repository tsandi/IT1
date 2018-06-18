<?PHP
    if ( $_GET['id']){
        $dat = $_GET['id'];
        
    $dir = 'uploads/';
    
    if ( @ unlink ($dir.$dat) )
    {
        echo 'Die Bilddatei wurde gelöscht!';
    }
    else
    {
        echo 'Konnte die Bilddatei nicht löschen!';
    }
    }
    ?>
<form>
<input type="button" value="OK" onclick="window.location.href='uploadNewPicture.php'" />
</form>

