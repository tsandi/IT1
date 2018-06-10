<?php
//PHP Kann auch ausgelagert werden, sollte man vielleicht auch machen.
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
                $currentData = file_get_contents('DataBaseJSON/BlogDataBase.JSON');
                $arrayData = json_decode($currentData, true);
                $synopsis = $_POST['content'];
                $newData = array(
                    'BlogID' => 5,
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
                }//*/
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

    function removeBlog($withID){
        $data = file_get_contents('teste_data.json');

        // decode json to associative array
        $json_arr = json_decode($data, true);

        // get array index to delete
        $arr_index = array();
        foreach ($json_arr as $key => $value) {
            if ($value['BlogID'] == $withID) {
                $arr_index[] = $key;
            }
}

        // delete data
        foreach ($arr_index as $i) {
            unset($json_arr[$i]);
        }

        // rebase array
        $json_arr = array_values($json_arr);

        // encode array to json and save to file
        file_put_contents('teste_data.json', json_encode($json_arr));

    }
?>

<!DOCTYPE html>
<html>

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script data-require="marked@*" data-semver="0.3.1" src="http://cdnjs.cloudflare.com/ajax/libs/marked/0.3.1/marked.js"></script>
	<script src="https://cdn.rawgit.com/toopay/bootstrap-markdown/master/js/bootstrap-markdown.js"></script>
	<script src="https://rawgit.com/lodev09/jquery-filedrop/master/jquery.filedrop.js"></script>
	<script src="https://rawgit.com/jeresig/jquery.hotkeys/master/jquery.hotkeys.js"></script>
    <script src="JavaScript/getBlogsForStartPage.js"></script>

	<link data-require="fontawesome@4.1.0" data-semver="4.1.0" rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous"/>
	<link rel="stylesheet" href="https://cdn.rawgit.com/toopay/bootstrap-markdown/master/css/bootstrap-markdown.min.css" />
	<link rel="stylesheet" href="Style/style.css" />
	<link rel="stylesheet" href="Style/markdown.css"/>
	<script type='text/javascript' src="JavaScript/bootstrap.js"></script>

</head>

<body>
	<div class="header">
		<h2>Blog Name</h2>
	</div>

	<nav class="navbar navbar-inverse">
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
				<li class="nav-item active">
                                    <a class="navbar-brand" href="startPage.html">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="navbar-brand dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Admin
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <a class="dropdown-item" href="createEditBlog.php">-Post a new blog-</a>
						<a class="dropdown-item" href="uploadNewPicture.php">-Upload a new picture-</a>
					</div>

				</li>
			</ul>
		</div>
	</nav>

	<div class=".container">
		<div class="row">

			<div class="col-md-2"></div>
			<div class="col-md-8 well well-sm">
				<div><h1></h1>

                    <form method="post">
                        <input name="title" id="title" type="text" id="title" placeholder="Blog Title"/>
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
                        <button type="button" value="Cancel" class="btn btn-info">Cancel</button>
                        <?php
                        if (isset($message))
                            echo $message;
                        ?>
                    </form>
                </div>
                <div style="padding-top: 50px">
                    <table id="blogTable" class="table">
                        <tr>
                            <th>Blog ID</th>
                            <th>Blog Title</th>
                            <th>Synopsis</th>
                            <th>Comments</th>
                            <th>Date</th>
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
</body>

</html>