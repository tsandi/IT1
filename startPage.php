
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
    <div class="col-md-3">
        <div class="card">
            <h2>About Me</h2>
            <div class="fakeimg" style="height:100px;">Image</div>
            <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
        </div>
        <div class="card">
            <h3>Popular Post</h3>
            <div class="fakeimg">Image</div><br>
            <div class="fakeimg">Image</div><br>
            <div class="fakeimg">Image</div>
        </div>
        <div class="card">
            <h3>Follow Me</h3>
            <p>Please I need the fame.</p>
        </div>
    </div>
</div>
</body>
</html>

