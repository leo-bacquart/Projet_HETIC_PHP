<?php

// Requete SQL
try {
    $dbClient = new PDO('mysql:host=localhost;dbname=projet_hetic', 'root', 'root');
} catch (Exception $e) {
    die('Error : '.$e->getMessage());
}
$dbQuery = 'SELECT * FROM users';
$usersStatement = $dbClient->query($dbQuery);
$userArray = $usersStatement->fetchAll();
$usersStatement->closeCursor();

$isLoggedIn = false;
$isAdmin = false;
$userID = '';

if (!isset($_SESSION['isLoggedIn'])) {
    $_SESSION['isLoggedIn'] = false;
}


if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $_SESSION['username'] = $username;
    $password = $_POST['password'];

    foreach ($userArray as $user) {
        if ($username == $user['username'] && $password == $user['password']) {
            $isLoggedIn = true;
            $_SESSION['isLoggedIn'] = true;
            $userID = $user['user_id'];
            $_SESSION['userID'] = $userID;
            if ($user['isAdmin']) {
                $isAdmin = true;
                $_SESSION['isAdmin'] = true;
            }
        }
    }
}
?>

<?php if (!$_SESSION['isLoggedIn'] || !isset($_SESSION['isLoggedIn'])): ?>
    <form action="#" method="post">
        <label for="username">Username : </label>
        <input type="text" name="username" id="username">
        <br><br>
        <label for="password">Password : </label>
        <input type="password" name="password" id="password">
        <br><br>
        <input type="submit" content="Submit">
    </form>
<?php else: ?>
    <div class="connected">Bonjour <?php
        if ($_SESSION['isAdmin']) {
            echo "<strong>{$_SESSION['username']}</strong>";
        } else {
            echo $_SESSION['username'];
        }
        ?>

    </div>
<?php endif; ?>