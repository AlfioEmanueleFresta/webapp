<?php

/*
 * Login page
 */

$error = false;

if ($_POST) {

    $username = strtolower($_POST['username']);
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $hint = $_POST['hint'];

    if ( !usernameIsValid($username) ) {
        $error = "The username must be alphanumeric and be 4-32 characters long.";

    } elseif ($password1 != $password2) {
        $error = "The passwords you inserted do not correspond.";

    } elseif ( empty($hint) ) {
        $error = "Please choose a password hint, in case you ever forget your password.";

    } elseif ( !passwordIsComplexEnough($password1) ) {
        $error = "The password needs to have at least {$conf['minimum_password_length']} characters.";
        
    } else {

        $query = $db->prepare("
            INSERT INTO     users (username, password, hint, role, salt)
                 VALUES     (:u, :p, :h, :r, :s)
        ");
        $success = $query->execute([
            ':u' => $username,
            ':p' => $password1,
            ':h' => $hint,
            ':r' => $conf["default_role"],
            ':s' => $conf["password_default_salt"],
        ]);

        if ($success) {
            $id = getUserIDByUsername($username);
            loginAs($id, $username, $conf['default_role']);
            redirectTo("index.php");

        } else {
            $error = "The username you chose is already in use.";

        }
        
    }

}

?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <h2>Register as a user</h2>

        <form method="POST" action="?page=register.php">

            <?php if ($error) { ?>
                <div class="alert alert-danger">
                    <?= $error; ?>
                </div>
            <?php } ?>

            <p>
                Username
                <input type="text" class="form-control" name="username" autofocus required
                       placeholder="Username" value="<?= @$_POST['username']; ?>">
            </p>

            <p>
                Password
                <input type="password" class="form-control" name="password1"
                       placeholder="Password">
            </p>

            <p>
                Repeat your password
                <input type="password" class="form-control" name="password2"
                       placeholder="Password">
            </p>

            <p>
                Password hint
                <input type="text" class="form-control" name="hint" required maxlength="255"
                       placeholder="Password hint" value="<?= @$_POST['hint']; ?>">
            </p>

            <button type="submit" class="btn btn-lg btn-block btn-success">
                <i class="glyphicon glyphicon-check"></i>
                Register
            </button>

            <p>If you already have an account, <a href="?page=login.php">click here to login</a>.</p>

        </form>

    </div>

</div>



