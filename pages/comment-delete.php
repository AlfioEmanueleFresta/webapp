<?php

$article_id = (int) $_GET['article_id'];
$comment_id = (int) $_GET['comment_id'];

if (!$user) {
    die("You need to be authenticated to delete your comments.");
}

// If the user is not part of the staff, they can only delete their own comments.
$ext = "";
if ($user['role'] != "staff") { $ext = " AND author_id = {$user['id']}"; }

$query = $db->exec("
    DELETE FROM comments WHERE id = $comment_id $ext
");

if (!$query) {
    die("An error occurred while deleting the comment from the database.");
}

redirectTo("read.php&article_id=$article_id&comment_deleted");
