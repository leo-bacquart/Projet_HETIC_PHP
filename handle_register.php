<?php
include_once('index.php');

try {
    $dbClient = new PDO('mysql:host=localhost;dbname=projet_hetic', 'root', 'root');
} catch (Exception $e) {
    die('Error : '.$e->getMessage());
}

if (isset($_POST['register_username']) && isset($_POST['register_password']) && $_POST['register_password'] === $_POST['register_confirm_password']) {
    $username = $_POST['register_username'];
    $_SESSION['username'] = $username;
    $password = $_POST['register_password'];

    $dbQuery ='INSERT INTO users (username, password, isAdmin) VALUES (:username, :password, false)';

    $createAccReq = $dbClient->prepare($dbQuery);

    $createAccReq->execute(array(
        'username' => $username,
        'password' => $password
    ));
    $createAccReq->closeCursor();


} ?>
<meta http-equiv="refresh" content="0;url=index.php">
