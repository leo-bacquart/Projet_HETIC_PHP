<?php
try {
    $dbClient = new PDO('mysql:host=localhost;dbname=projet_hetic', 'root', 'root');
} catch (Exception $e) {
    die('Error : '.$e->getMessage());
}

if (!isset($offset)) {
    $offset = 0;
}

$postQuery =
    '
    SELECT p.post_id, p.title, p.content, p.created_at, GROUP_CONCAT(t.name) as tags, u.username
    FROM posts p
    INNER JOIN post_tags pt ON p.post_id = pt.post_id
    INNER JOIN tags t ON pt.tag_id = t.tag_id
    INNER JOIN users u ON p.user_id = u.user_id
    GROUP BY p.title, p.content, p.created_at, u.username, p.post_id
    ORDER BY p.created_at DESC
    LIMIT 10 
    OFFSET '. $offset .';
    ';

$postStatement = $dbClient->query($postQuery);
$postsArray = $postStatement->fetchAll();
$postStatement->closeCursor();

foreach ($postsArray as $post): ?>
<div class="post box column">
    <div class="columns">
        <div class="title column">
            <h4 class="title is-4">
                <?php echo $post['title'] ?>
            </h4>
        </div>
        <div class="columns column is-4">
            <div class="author column">
                <?php echo $post['username'] ?>
            </div>
            <div class="created-at column">
                <?php echo date('d/m/y H:i', strtotime($post['created_at'])) ?>
            </div>
            <div class="column is-2">
                <?php if ($_SESSION['isAdmin']): ?>
                <a href="handle_delete.php?id=<?php echo $post['post_id']?>"><button class="delete"></button></a>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <div class="content">
        <?php echo $post['content'] ?>
    </div>
    <div class="tags">

        <?php
            $tagArray = explode(',', $post['tags']);

            foreach ($tagArray as $tag) {
                if (strlen($tag) > 0) {
                    echo "<span class='tag'>". $tag ."</span>";
                }
            }
        ?>
    </div>
</div>
<?php endforeach; ?>