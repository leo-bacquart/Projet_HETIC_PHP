<?php
include_once ('index.php');

$tweet_id = $_GET['id'];

try {
    $dbClient = new PDO('mysql:host=localhost;dbname=projet_hetic', 'root', 'root');
} catch (Exception $e) {
    die('Error : '.$e->getMessage());
}

$dbQuery = '
    DELETE FROM post_tags
    WHERE post_id = '. $tweet_id .';

    DELETE FROM posts
    WHERE post_id = '. $tweet_id .';

    DELETE FROM comments
    WHERE post_id = '. $tweet_id .';';

if ($_SESSION['isAdmin']) {
    $deleteStatement = $dbClient->prepare($dbQuery);
    $deleteStatement->execute();
}

?>
<meta http-equiv="refresh" content="0;url=index.php">
