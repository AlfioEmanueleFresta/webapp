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
 * @param $salt     The salt to prepend.
 * @return The hash string of the password.
 */
function hashPassword($password, $salt) {
    $password = "{$salt}{$password}";
    return hash('sha256', $password);
}


/*
 * Get the salt for the user by its username.
 * If the user does not exist, return the default salt.
 * @param $username The username of the user you want to get the salt for.
 * @return The salt for the username or, if it does not exist, the default salt.
 */
function getSaltByUsername($username) {
    global $db, $conf;
    $username = $db->quote(strtolower($username));
    $q = $db->query("SELECT salt FROM users WHERE username = $username");
    $r = $q->fetch(PDO::FETCH_ASSOC);
    if (!$r) { return $conf["password_default_salt"]; }
    return $r['salt'];
}


/*
 * Sets the session as a user
 * @param $username     The username
 * @param $role         The user role
 */
function loginAs($id, $username, $role) {
    $_SESSION['id']         = $id;
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


/*
 * Utility function to get a user ID by username
 * @param $username The username of the user.
 * @return The user ID of the user or null if the username does not exist.
 */
function getUserIDByUsername($username) {
    global $db;
    $username = $db->quote($username);
    $q = $db->query("SELECT id FROM users WHERE username = $username");
    $r = $q->fetch(PDO::FETCH_ASSOC);
    if (!$r) { return null; }
    return $r['id'];
}


function printSQLError($queryString) {
    global $db;
    $errorText = $db->errorInfo()[2];
    echo "
            <div class='alert alert-danger'>
                <h4><i class='glyphicon glyphicon-warning-sign'></i> SQL Error</h4>
                <table class='table'>
                    <tr><td>SQL Query</td><td class='monospace'>{$queryString}</td></tr>
                    <tr><td>Error message</td><td class='monospace'>{$errorText}</td></tr>
                </table>
            </div>
        ";
}


/*
 * This method is used if the plain text password lookup did not work --
 * This is because some users have a plain text password and some don't, for the
 * purposes of the different practicals.
 *
 * @param $username The username.
 * @param $password The password, as inserted by the user.
 * @return array|false An array with the result or false.
 */
function tryMoreComplicatedLoginMethod($username, $password) {
    global $db;

    // Hash the password, with a pinch of salt.
    $password = hashPassword($password, getSaltByUsername($username));

    $query = $db->prepare("SELECT id, role, username FROM users WHERE username = :u AND password_hash = :p");
    $query->bindValue(':u', $username);
    $query->bindValue(':p', $password);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
}


/**
 * This function will delete all user-generated content in the last day, plus
 * all users with ID greater than 130 (as defined in setup.sql as starting number
 * for new IDs).
 * @return int The number of entities removed from the database.
 */
function resetDatabase() {
    global $db;
    $yesterday = time() - (60 * 60 * 24);
    $total = 0;
    $total += $db->exec("DELETE FROM comments WHERE timestamp > $yesterday");
    $total += $db->exec("DELETE FROM users WHERE id >= 130");
    return $total;
}



/**
 * Uses `git` to discard any changes to the application code. Also, make sure
 * the configuration file is preserved.
 */
function resetCode() {
    $output = "";
    $return = -42;
    $config = file_get_contents("inc/configuration.php");
    $output = system("git checkout -- . 2>&1", $return);
    if ($return) {
        $output .= "\n(ERROR CODE $return)";
    }
    file_put_contents("inc/configuration.php", $config);
    return $output;
}


/**
 * Prepares the article body for display in a HTML page.
 * @param $body Raw text article body.
 * @return HTML article body.
 */
function prepareArticleBody($body) {
    $body = nl2br($body);
    return $body;
}