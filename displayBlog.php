
<div id="blogDisply">
    <?php
    if ( $_GET['page']){
        $blogId = $_GET['page'];
        //echo $blogId;
        $blog = file_get_contents('BlogDataBase.JSON');
        $allBlogs = json_decode($blog, true);
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
    }
    ?>
</div>
