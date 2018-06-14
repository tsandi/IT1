<?php
//PHP Kann auch ausgelagert werden, sollte man vielleicht auch machen.
    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
    $setTitel ='';
    $setContent ='';
    $message = '';
    $errorTitle = '';
    $errorContent = '';
    if ($_GET['page']){
        $blogId = $_GET['page'];
        $blog = file_get_contents('DataBaseJSON/BlogDataBase.JSON');
        $allBlogs = json_decode($blog, true);
        foreach($allBlogs as $value){
            if($value['BlogID'] == $blogId){
                $setTitle = $value['Title'];
                $setContent = $value['Content'];
            }
        }
    }
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
                $newData = array(
                    'BlogID' => checkIfIDIsTaken(),
                    'Title' => $_POST['title'],
                    'Date' => date("j.n.Y"),
                    'Synopsis' => shortenContent($synopsis),
                    'Content' => $_POST['content'],
                    'Comments' => 0
                );
                $arrayData[] = $newData;
                $finalData[] = json_encode($arrayData);
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

    function checkIfIDIsTaken(){
        $blog = file_get_contents('DataBaseJSON/BlogDataBase.JSON');
        $allBlogs = json_decode($blog, true);
        foreach($allBlogs as $value){
            $id = 0;
            if ($id <= (int)$value['BlogID']){
                $id = (int)$value['BlogID'];
            }
        }
        return ($id+1);
    }

?>

<?php
    if(isset($_POST['btnDelete'] )){
        echo $_POST['toBeDeleted'];
        $toBeDeleted = $_POST['toBeDeleted'];
        $blog = file_get_contents('DataBaseJSON/BlogDataBase.JSON');
        $allBlogs = json_decode($blog, true);
        $search = array_search($toBeDeleted, $allBlogs);
        if($search !== false) unset($fobj[$search]);
        echo $filters = json_encode($fobj);
    }
?>



<?php
include ("_header.php");
?>

<div class=".container">
    <div class="row">

        <div class="col-md-2"></div>
        <div class="col-md-8 well well-sm">
            <div><h1></h1>

                <form method="post">
                    <input name="title" id="title" type="text" id="title" placeholder="Blog Title" value="<?php if (isset($setTitle)) echo ($setTitle); ?>"/>
                    <?php
                    if (isset($errorTitle))
                        echo $errorTitle;
                    ?>

                    <textarea id="comment-md" name="content" placeholder="Blog Content"></textarea>
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
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<?php
include ("_footer.php");
?>