<?php

$id = $_GET['article_id'];

$query = $db->query("
    SELECT      title, 
                timestamp,
                author_id, 
                users.username as author_username,
                users.role as author_role,
                body
    FROM        articles, users
    WHERE       articles.author_id = users.id
    AND         articles.id = $id
");
$query->execute();

$article = $query->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    // Article not found
    redirectTo("404.php");
}

?>

<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <h2><?= $article["title"]; ?></h2>
        <p>
            By <strong><?= $article["author_username"]; ?></strong> (<?= $article["author_role"]; ?>),
            posted on <?= date('d/m/Y H:i', $article["timestamp"]); ?>
        </p>
        <p>
            <a href="?page=index.php">Return to the home page</a>.
        </p>
        <hr />
        <p>
            <?= $article["body"]; ?>
        </p>


    </div>
</div>