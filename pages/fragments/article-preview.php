<h4><?= $article["title"]; ?></h4>
<p>Posted by <?= $article["author_username"]; ?> on <?= date('d/m/Y H:i', $article["timestamp"]); ?></p>
<p>
    <a href="?page=read.php&article_id=<?= $article["article_id"]; ?>">
        Read the article &raquo;
    </a>
</p>
<p>&nbsp;</p>