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
    <title>Accueil</title>
    <style>
        @import "https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css";
    </style>
</head>
<body>
<div class="column is-four-fifths is-offset-1">

<!-- Page login -->
<?php
include_once('handle_login.php');
global $isLoggedIn;
global $isAdmin;
?>



<!-- Possibilité de poster uniquement si user est connecté -->
<?php if ($_SESSION['isLoggedIn']): ?>

    <a href="post.php" class="button is-info"> Post</a>

    <?php
    function disconnect() {
        session_destroy();
    }
    if (isset($_GET['disconnect'])) {
        disconnect();
    }
    ?>
    <a href='index.php?disconnect=true' class="button is-danger">Disconnect</a>


<!-- Post -->
<?php include_once ('show_posts.php'); ?>


<?php endif; ?>


</div>
</body>
</html>