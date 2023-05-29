<?php

// Requete SQL
try {
    $db = new PDO('mysql:host=localhost;dbname=projet_hetic', 'root', 'root');
} catch (Exception $e) {
    die('Error : '.$e->getMessage());
}
$request = 'SELECT * FROM users';
$users_response = $db->query($request);

$isLoggedIn = false;
$isAdmin = false;

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    foreach ($users_response as $user) {
        if ($username == $user['username'] && $password == $user['password']) {
            $isLoggedIn = true;
            if ($user['isAdmin']) {
                $isAdmin = true;
            }
        }
    }
}
?>

<?php if (!$isLoggedIn): ?>
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
        if ($isAdmin) {
            echo "<strong>{$username}</strong>";
        } else {
            echo $username;
        }
        ?>

    </div>
<?php endif; ?>