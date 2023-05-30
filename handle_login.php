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


if (isset($_POST['login_username']) && isset($_POST['login_password'])) {
    $username = $_POST['login_username'];
    $_SESSION['username'] = $username;
    $password = $_POST['login_password'];

    foreach ($userArray as $user) {
        if ($username == $user['username'] && $password == $user['password']) {
            $isLoggedIn = true;
            $_SESSION['isLoggedIn'] = true;
            $userID = $user['user_id'];
            $_SESSION['userID'] = $userID;
            if ($user['isAdmin']) {
                $isAdmin = true;
                $_SESSION['isAdmin'] = true;
            } else {
                $_SESSION['isAdmin'] = false;
            }
        }
    }
}
?>

<?php if (!$_SESSION['isLoggedIn'] || !isset($_SESSION['isLoggedIn'])): ?>
        <form action="#" method="post" class="column is-half box is-offset-one-quarter">
            <div class="field">
                <label for="login_username" class="label">Username : </label>
                <input type="text" name="login_username" id="login_username" class="input">
            </div>

            <div class="field">
                <label for="login_password" class="label">Password : </label>
                <input type="password" name="login_password" id="login_password" class="input">
            </div>

            <div class="field">
                <input type="submit" content="Submit" class="button is-link" value="Login">
            </div>

        </form>
    <br>
        <form action="handle_register.php" method="post" class="column is-half box is-offset-one-quarter">
            <div class="field">
                <label for="register_username" class="label">Username : </label>
                <input type="text" name="register_username" id="register_username" class="input">
            </div>

            <div class="field">
                <label for="register_password" class="label">Password : </label>
                <input type="password" name="register_password" id="register_password" class="input">
            </div>

            <div class="field">
                <label for="register_confirm_password" class="label">Confirm password : </label>
                <input type="password" name="register_confirm_password" id="register_confirm_password" class="input">
            </div>

            <div class="field">
                <input type="submit" content="Submit" class="button is-primary" value="Register">
            </div>

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