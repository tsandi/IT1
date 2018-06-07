<?php
/**
 * Created by PhpStorm.
 * User: Tejan
 * Date: 07.06.18
 * Time: 10:55
 */
    $message = '';
    $error = '';
    if (isset($_POST['submit'])){

        if (emtpy($_POST["title"])){
            $error = "<label class='text-danger'>Enter Title</label>";
        }else if (empty($_POST["content"])){
            $error = "<label class='text-danger'>Enter Content</label>";
        }else{
            if (file_exists('BlogDataBase.JSON')){
                $currentData = file_get_contents('BlogDataBase.JSON');
                $arrayData = json_decode($currentData, true);
                $newData = array(
                    'BlogID' => 5,
                    'Title' => $_POST['title'],
                    'Date' => date(d.m.Y),
                    'Synopsis' => null,
                    'Content' => $_POST['content'],
                    'Comment' => 0
                );
                $arrayData[] = $newData;
                $finalData[] = json_encode($arrayData);
                if (file_put_contents('BlogDataBase.JSON', $finalData)){
                    $message = "<label class='text-danger'>File Appended Successfully</label>";
                }
            }else{
                $error = 'JSON file does not exist';
            }
        }
    }
?>

<html>
<head>
    <title>This is a test</title>
    <script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <br />
    <div class="container" style="width: 500px;">
        <h3 align="">Append Data to JSON File</h3>
        <form method="post">
            <?php
                if (isset($error))
                    echo $error;
            ?>
            <label>Title</label>
            <input type="title" name="title" class="form-control"/><br/>
            <label>Content</label>
            <input type="content" name="content" class="form-control"/><br/>
            <input type="submit" name="submit" value="Append" class="btn">
            <?php
            if (isset($message))
                echo $message;
            ?>
        </form>
    </div>
    <br />
</body>
</html>
