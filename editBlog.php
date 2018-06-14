<?php
if ($_GET['page']){
    $blogTitle = '';
    $blogConetent ='';
    $blogId = $_GET['page'];
    $blog = file_get_contents('DataBaseJSON/BlogDataBase.JSON');
    $allBlogs = json_decode($blog, true);
    foreach($allBlogs as $value){
        $newID = $value['BlogID'];
        if($value['BlogID'] == $blogId){
            $blogTitle = $value['Title'];
            $blogContent = $value['Content'];
        }
    }
}
?>

<?php
//PHP Kann auch ausgelagert werden, sollte man vielleicht auch machen.
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
$setTitel ='';
$setContent ='';
$message = '';
$errorTitle = '';
$errorContent = '';
if (isset($_POST['submit'])){
    if (empty($_POST["title"])){
        $errorTitle = "<label class='text-danger'>Enter Title</label>";
    }
    if (empty($_POST["content"])){
        $errorContent = "<label class='text-danger'>Enter Content</label>";
    }
    if ($_POST["title"] && $_POST["content"]){
        if (file_exists('DataBaseJSON/BlogDataBase.JSON')){
            $currentData = file_get_contents('BlogDataBase.JSON');
            $arrayData = json_decode($currentData, true);
            $synopsis = $_POST['content'];
            $blogId = $_GET['page'];
            $blog = file_get_contents('DataBaseJSON/BlogDataBase.JSON');
            $allBlogs = json_decode($blog, true);
            foreach($allBlogs as $key => $field){
                if($field['BlogID'] == $blogId){
                    //$allBlogs[$key]['BlogID'] = $blogId;
                    $allBlogs[$key]['Title'] = $_POST['title'];
                    $allBlogs[$key]['Date'] = date("j.n.Y");
                    $allBlogs[$key]['Synopsis'] = shortenContent($synopsis);
                    $allBlogs[$key]['Content'] = $_POST['content'];
                }
            }
            $finalData[] = json_encode($allBlogs);
            if (file_put_contents('DataBaseJSON/BlogDataBase.JSON', $finalData)){
                $message = "<label class='text-danger'>File Appended Successfully</label>";
            }
        }else{
            $message = 'JSON file does not exist';
        }
    }else{
        $message = 'Cannot append if empty';
    }
}
function shortenContent($content){
    if (strlen($content) > 100)
    {
        $offset = (100 - 3) - strlen($content);
        $content = substr($content, 0, strrpos($content, ' ', $offset)) . '...';
    }
    return $content;
}
?>


<?php
include ("_header.php");
?>
<div class="well well-large">
    <form method="post">
        <input name="title" id="title" type="text" id="title" placeholder="Blog Title" value="<?php if (isset($blogTitle)) echo ($blogTitle); ?>"/>
        <?php
        if (isset($errorTitle))
            echo $errorTitle;
        ?>

        <textarea id="comment-md" name="content" placeholder="Blog Content"><?php if (isset($blogContent)) echo ($blogContent); ?></textarea>
        <br />
        <div id="comment-md-preview-container">
            <div class="well well-sm well-light md-preview margin-top-10" id="comment-md-preview"></div>
            <?php
            if (isset($errBlogContent))
                echo $errBlogContent;
            ?>
        </div>

        <input type="submit" name="submit" value="Submit" class="btn btn-success">
        <?php
        if (isset($message))
            echo $message;
        ?>
    </form>
</div>
<div style="padding-top: 50px">
    <table id="blogTable" class="table">
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </table>
    <script>
        loadValues();
    </script>
    <table id="otherTable" class="table"></table>
</div>

<?php
include ("_footer.php");
?>



