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
    <style>
        @import "https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css";
    </style>
    <title>Post</title>
</head>
<body>
<form action="handle_post.php" method="post" class="column is-three-fifths is-offset-one-fifth">

    <div class="field">
        <label for="title" class="label">Title : </label>
        <div class="control">
            <input type="text" name="title" id="title" class="input">
        </div>
    </div>

    <div class="field">
        <label for="post_content" class="label">Content : </label>
        <textarea id="post_content" name="post_content" class="textarea"></textarea>
    </div>

    <div class="field">
        <label for="tags" class="label">Tags (Separate by space) : </label>
        <input type="text" name="tags" id="tags" class="input">
    </div>

    <div class="field is-grouped">
        <div class="control">
            <input type="submit" content="Post" class="button is-link">
        </div>
        <div class="control">
            <a href="index.php" class="button is-light is-link">Cancel</a>
        </div>
    </div>



</form>
</body>
</html>



