<?php

if (!($user and $user["role"] == "staff")) {
    die("You are not authorised to access this page.");
}

$query = "SELECT id, username, password, hint FROM users";
$query = $db->query($query);
$query->execute();

$users = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<table class="table table-bordered table-condensed">

    <thead>
        <th>ID</th>
        <th>Username</th>
        <th>Password Hash</th>
        <th>Password Hint</th>
    </thead>

    <?php foreach ($users as $user) { ?>
    <tr>
        <?php foreach ($user as $field) { ?>
            <td><?= $field; ?></td>
        <?php } ?>
    </tr>
    <?php } ?>

</table>
