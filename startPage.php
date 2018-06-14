<?php
include("_header.php");
?>


<?php
    $blog = file_get_contents('DataBaseJSON/BlogDataBase.JSON');
    $allBlogs = json_decode($blog, true);
    foreach($allBlogs as $value){
        echo "<div class='well well-large'>";
        echo "<h3>";
        echo $value['Title'];
        echo "</h3>";
        echo "<h5>";
        echo $value['Date'];
        echo "</h5>";
        echo "<p>";
        echo $value['Synopsis'];
        echo "<a href=\"displayBlog.php?page=";
        echo $value['BlogID'];
        echo "\">mehr</a>";
        echo "</p>";
        echo "</div>";
    }

?>
<?php
include ("_footer.php");
?>

