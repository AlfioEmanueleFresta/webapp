<?php

$article_id = (int) $_POST['article_id'];

if (!$user) {
    die("You need to be authenticated to comment.");
}

$body = $_POST['body'];
$body = $db->quote($body);
$timestamp = time();

if (empty($body)) {
    die("Your comment can't be empty.");
}

$query = $db->exec("
    INSERT INTO   comments (author_id, article_id, timestamp, body)
         VALUES   ({$user['id']}, $article_id, $timestamp, $body)
");

if (!$query) {
    die("An error occurred while saving the comment into the database.");
}

redirectTo("read.php&article_id=$article_id&comment_posted");
