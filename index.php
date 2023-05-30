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
</head>
<body>


<!-- Page login -->
<?php
include_once('handle_login.php');
global $isLoggedIn;
global $isAdmin;
?>



<!-- Possibilité de poster uniquement si user est connecté -->
<?php if ($_SESSION['isLoggedIn']): ?>

    <a href="post.php"> Poster</a>

    <?php
    function disconnect() {
        session_destroy();
    }
    if (isset($_GET['disconnect'])) {
        disconnect();
    }
    ?>
    <a href='index.php?disconnect=true'>Disconnect</a>


<!-- Post -->

<?php endif; ?>


</body>
</html>