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


/*
 * Check if a password is complex enough to be used.
 * @param $password The password to check.
 * @return true if $password is long enough, false otherwise.
 */
function passwordIsComplexEnough($password) {
    global $conf;
    return strlen($password) >= $conf["minimum_password_length"];
}


/*
 * Get a hash for the password.
 * @param $password The plain text password.
 * @return The hash string of the password.
 */
function hashPassword($password) {
    return hash('sha256', $password);
}


/*
 * Sets the session as a user
 * @param $username     The username
 * @param $role         The user role
 */
function loginAs($username, $role) {
    $_SESSION['username']   = $username;
    $_SESSION['role']       = $role;
}


/*
 * Checks whether the username is valid
 * @param $username     The username
 * @return  True if the username is valid, false otherwise.
 */
function usernameIsValid($username) {
    $l = strlen($username);
    if ($l < 4 or $l > 32) { return false; }
    if (!ctype_alnum($username)) { return false; }
    return true;
}
