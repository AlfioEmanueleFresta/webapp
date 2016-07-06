<?php

/*
 * This function should search through the articles
 *  in the database given a search query.
 * @param $query The search terms.
 * @return A list of associative arrays representing articles.
 */
function searchArticles($query) {

    global $db;

    $q = $db->prepare("SELECT FROM articles WHERE title LIKE :q");
    if (!$q) { return []; }

    $q->bindValue(':q', $query);
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
    return $_SESSION['username'];

}