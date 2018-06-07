<?php
    $message = '';
    $error = '';
    $errBlogContent = '';
    $errBlogTitle = '';
    $result = '';
    if(isset($_POST["submit"])){
        console.log("Submit worked");
        $blogTitle = $_POST['title'];
        $blogContent = $_POST['content'];
        //Check if inputs are empty
        if (empty($_POST["title"])){
            $errBlogTitle = 'Bitte einen Titel eingeben';
        }
        else if (empty($_POST["content"])){
            $errBlogContent = 'Bitte Inhalt eingeben';
        }
        else{
            if(file_exists('DataBaseJSON/BlogDataBase.JSON')){
                $currentData = file_get_contents('DataBaseJSON/BlogDataBase.JSON');
                $thisData = json_decode($currentData, true);
                $newData = array(
                    'BlogID' => 5,
                    'Title' => $_POST['title'],
                    'Date' => date(d.m.Y),
                    'Synopsis' => null,
                    'Content' => $_POST['content'],
                    'Comment' => 0
                );
                $arrayData[] = $newData;
                $finalData = json_encode($arrayData);
                if (file_put_contents('DataBaseJSON/BlogDataBase.JSON', $finalData)){
                    $result = '<div class="alert alert-danger">Should have saved and I am awesome.</div>';
                }
            }
            else{
                $result = '<div class="alert alert-danger">JSON File does not exists.</div>';
            }
        }
    }

    function shortenContent($content){
        if (strlen($content) > 100)
        {
            $offset = (100 - 3) - strlen($content);
            $content = substr($content, 0, strrpos($content, ' ', $offset)) . '...';
            return $content;
        }
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
					<a class="navbar-brand" href="#">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="navbar-brand dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Admin
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
						<a class="dropdown-item" href="#">-Post a new blog-</a>
						<a class="dropdown-item" href="#">-Upload a new picture-</a>
					</div>
				</li>
			</ul>
		</div>
	</nav>

	<div class=".container">
		<div class="row">

			<div class="col-md-2"></div>
			<div class="col-md-8" style="border-style: dashed">
				<h1></h1>

				<form method="post">
					<input name="title" id="title" type="text" id="title" placeholder="Blog Title"/>
					<?php echo "<p class='errText'>$errBlogTitle</p>";?>

					<textarea id="comment-md" name="content" placeholder="Blog Content"></textarea>
					<br />
					<div id="comment-md-preview-container">
						<div class="well well-sm well-light md-preview margin-top-10" id="comment-md-preview"></div>
                        <?php echo "<p class='errText'>$errBlogContent</p>";?>
                    </div>

                    <input type="submit" name="submit" value="Submit">
					<button type="button" value="Cancel">Cancel</button>
				</form>
                <?php echo $result; ?>
            </div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>

</html>