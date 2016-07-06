<?php

/*
 * This function should search through the articles
 *  in the database given a search query.
 * @param $query The search terms.
 * @return A list of associative arrays representing articles.
 */
function searchArticles($query) use ($db) {

    $q = $db->query("SELECT FROM articles WHERE title LIKE :q");
    $q->bindValue(':q', $query);
    $q->execute();

    $r = $q->fetchAll(PDO::FETCH_ASSOC);
    return $r;

}

