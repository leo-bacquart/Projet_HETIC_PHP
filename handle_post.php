<?php
include_once('index.php');

try {
    $dbClient = new PDO('mysql:host=localhost;dbname=projet_hetic', 'root', 'root');
} catch (Exception $e) {
    die('Error : '.$e->getMessage());
}

if (isset($_POST['title']) && isset($_POST['post_content'])) {
    $title = $_POST['title'];
    $content = $_POST['post_content'];
    $tagsArray = explode(' ', $_POST['tags']);

    $selectTagsQuery = 'SELECT * FROM tags';
    $insertContentQuery = 'INSERT INTO posts (user_id, title, content) VALUES (:user_id, :title, :content)';
    $insertTagsQuery = 'INSERT INTO tags (name) VALUES (LOWER(:name))';
    $insertManyToManyQuery = 'INSERT INTO post_tags (post_id, tag_id) VALUES (:post_id, :tag_id)';

    $tagsStatement = $dbClient->query($selectTagsQuery);
    $contentReq = $dbClient->prepare($insertContentQuery);
    $tagsReq = $dbClient->prepare($insertTagsQuery);
    $manyToManyReq = $dbClient->prepare($insertManyToManyQuery);

    $existingTags = $tagsStatement->fetchAll();
    $tagsStatement->closeCursor();

    $contentReq->execute(array(
        'user_id' => $_SESSION['userID'],
        'title' => $title,
        'content' => $content
    ));
    $postID = $dbClient->lastInsertId();
    $contentReq->closeCursor();

    foreach ($tagsArray as $tag) {

        $tagExists = false;
        foreach ($existingTags as $existingTag) {
            if ($existingTag['name'] == $tag) {
                $tagExists = true;
                $tagID = $existingTag['tag_id'];
            }
        }

        if (!$tagExists) {
            $tagsReq->execute(array(
                'name' => $tag
            ));
            $tagID = $dbClient->lastInsertId();
            $tagsReq->closeCursor();
        }


        $manyToManyReq->execute(array(
                'post_id' => $postID,
                'tag_id' => $tagID
        ));
        $manyToManyReq->closeCursor();
    }
}
?>
<meta http-equiv="refresh" content="0;url=index.php">
