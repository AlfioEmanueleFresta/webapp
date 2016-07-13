<?php

$id = (int) $_GET['article_id'];

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

$query = $db->query("
    SELECT      users.username as author_username,
                timestamp,
                body,
                comments.id as comment_id
    FROM        comments, users
    WHERE       comments.author_id = users.id
    AND         comments.article_id = $id
    ORDER BY    timestamp DESC, id DESC
    LIMIT       0, 10
");
$query->execute();
$comments = $query->fetchAll(PDO::FETCH_ASSOC);
$commentsNo = count($comments);

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

        <hr />



        <h4>Comments (<?= $commentsNo; ?>)</h4>

        <?php if ($user) { ?>
            <form action="?page=comment.php" method="POST" class="well">
                <strong><i class="glyphicon glyphicon-pencil"></i> Write a new comment...</strong>
                <input type="hidden" name="article_id" value="<?= $id; ?>" />
                <div class="row">
                    <div class="col-md-10">
                        <textarea class="form-control" rows="2" name="body" required
                                  placeholder="Comment publicly as <?= $user['username']; ?>..."></textarea>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-block btn-primary">
                            <i class="glyphicon glyphicon-send"></i>
                            Send
                        </button>
                    </div>
                </div>
            </form>


        <?php } else { ?>
            <div class="alert alert-info">
                <i class="glyphicon glyphicon-lock"></i>
                You need to be authenticated to be able to comment on articles.
                Please <a href="?page=login.php">Login</a> or <a href="?page=register.php">Register</a>.
            </div>

        <?php } ?>

        <?php foreach ($comments as $comment) { ?>

            On the <?= date('d/m/Y H:i', $comment["timestamp"]); ?>,
            <strong><?= $comment['author_username']; ?></strong> wrote:

            <?php if ($user['role'] == "staff" or $user['username'] == $comment['author_username']) { ?>
                <a  class="pull-right text-danger"
                    href="?page=comment-delete.php&comment_id=<?= $comment['comment_id']; ?>&article_id=<?= $id; ?>">
                    <i class="glyphicon glyphicon-trash"></i> delete this comment
                </a>
            <?php } ?>

            <blockquote>
                <?= $comment['body']; ?>
            </blockquote>

        <?php } ?>

    </div>
</div>