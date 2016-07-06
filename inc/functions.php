<?php

/*
 * This function should search through the articles
 *  in the database given a search query.
 * @param $query The search terms.
 * @return A list of associative arrays representing articles.
 */
function searchArticles($query) {

    global $db;
    
    $q = $db->query("
        SELECT    articles.id as article_id,
                  title,
                  author_id,
                  users.username as author_username,
                  users.role as author_role,
                  timestamp,
                  body
        FROM      articles, users
        WHERE     articles.author_id = users.id
        AND       title LIKE '%$query%'
    ");
    $q->execute();

    $r = $q->fetchAll(PDO::FETCH_ASSOC);
    return $r;

}


/*
 * This function returns the current logged in user or
 * null if the user is not logged in.
 * @return The username of the current user or null.
 */
function getCurrentUser() {

    global $_SESSION;

    if (empty($_SESSION['username'])) {
        return null;
    }

    return [
        "id"        => $_SESSION['id'],
        "username"  => $_SESSION['username'],
        "role"      => $_SESSION['role'],
    ];

}


/*
 * Redirect the user to a different page.
 */
function redirectTo($page) {
    header("Location: ?page=$page");
    exit(0);
}