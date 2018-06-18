<?php
include("_header.php");
?>

<?php
if ($_GET['page']){
    $blogId = $_GET['page'];
    //echo $blogId;
    $blog = file_get_contents('DataBaseJSON/BlogDataBase.JSON');
    $allBlogs = json_decode($blog, true);
    echo "<div class='well well-large'>";
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
    echo "</div>";
}
?>
<div id="blogComments" class="container">
    <form action="" method="POST">
        <h1> Leave a comment<br> </h1>
        <div class="form-group">
            <label> Name: <br><input type="text" name="name"><br></label>
        </div>
        <div class="form-group">
            <label> Email: <br><input type="text" name="email"><br></label>
        </div>
        <div class="form-group">
            <label> Comment: <br><textarea rows="5" name="mes" class="form-control"></textarea><br></label>
        </div>
        <input type="submit" name="post" value="Post">
    </form>
</div>

<?php
include ("commentForBlog.php");
?>



<?php
include ("_footer.php");
?>
