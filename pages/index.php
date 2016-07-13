<h2>Latest articles</h2>
<p>Here is a list of the most recent articles from our website!</p>
<p>&nbsp;</p>

<?php
$query = $db->query("
    SELECT    articles.id as article_id, 
              timestamp, author_id, 
              username as author_username,
              title, body
    FROM      articles, users
    WHERE     articles.author_id = users.id
    ORDER BY  timestamp DESC
    LIMIT     0, 10
");
$query->execute();
$articles = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ( $articles as $article ) {
    include('./pages/fragments/article-preview.php');
}
