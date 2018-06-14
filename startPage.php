
<?php
include("_header.php");
?>

<div class=".container">
    <div class="row">
    <h1> Informations-Box <br> </h1>
        <div class="col-md-2"></div>
        <div class="col-md-8" style="background: #4CAF50">
            <!--Place Content HERE-->
            <h1 id="getTile"></h1>
            <p id="getSynopsis"></p>

            <table id="blogTable" class="table">

            </table>

        </div>
        <div class="col-md-2"></div>
        <table></table>

    </div>
</div>
<div class="row container-fluid">
    <div class="col-md-1"></div>
    <div class="col-md-8">
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
                echo "<a href=\"displayBlog.php/?page=";
                echo $value['BlogID'];
                echo "\">mehr</a>";
                echo "</p>";
                echo "</div>";
            }

        ?>
    </div>
    <?php
    include("_sidebar.php");
    ?>
</div>
</body>
</html>

