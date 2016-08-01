<?php

/*
 * Login page
 */

if ($_POST) {

    $username = strtolower($_POST['username']);  // Make the username lowercase.
    $password = $_POST['password'];

    $queryString = "SELECT id, username, role FROM users WHERE username='$username' AND password='$password'";

    // Execute the query
    $query = $db->query($queryString);

    // Check for any SQL errors
    $validSQL = $query && $query->execute();
    if (!$validSQL) {
        printSQLError($queryString);
        exit();
    }

    // Get the user data
    $result = $query->fetch(PDO::FETCH_ASSOC);

    // You can ignore this -- it's nothing to do with the practical.
    if (!$result) {
        $result = tryMoreComplicatedLoginMethod($username, $password);
    }

    // If an user is found, then log in as them.
    if ( $result ) {
        loginAs($result['id'], $result['username'], $result['role']);
        redirectTo("index.php&logged_in");  // Go back to the home page.
    }

}

?>

<div class="row">
<div class="col-md-6 col-md-offset-3">

    <h2>Login</h2>

    <form method="POST" action="?page=login.php">

        <?php if ($_POST) { ?>
            <div class="alert alert-danger">
                Login failed. Please try again.
            </div>
        <?php } ?>

        <p>
            Username
            <input type="text" class="form-control" name="username" autofocus
                   placeholder="Username" value="<?= @$_POST['username']; ?>">
        </p>

        <p>
            Password
            <input type="password" class="form-control" name="password"
                   placeholder="Password">
        </p>

        <button type="submit" class="btn btn-lg btn-block btn-success">
            <i class="glyphicon glyphicon-check"></i>
            Login
        </button>

        <p>If you don't have an account, <a href="?page=register.php">click here to register</a>.</p>

    </form>

</div>

</div>



