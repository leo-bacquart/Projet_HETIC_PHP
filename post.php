<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post</title>
</head>
<body>
<form action="handle_post.php" method="post">
    <label for="title">Title : </label>
    <input type="text" name="title" id="title">
    <label for="post_content">Content : </label>
    <br>
    <textarea id="post_content" name="post_content"></textarea>
    <br>
    <label for="tags">Tags (Separate by space) : </label>
    <input type="text" name="tags" id="tags">
    <br>
    <input type="submit" content="Post">
</form>
</body>
</html>



