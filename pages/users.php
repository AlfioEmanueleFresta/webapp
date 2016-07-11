<?php

if (!($user and $user["role"] == "staff")) {
    die("You are not authorised to access this page.");
}

$query = "SELECT id, username, password, hint FROM users";
$query = $db->query($query);
$query->execute();

$users = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['download'])) {

    ob_clean();
    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename=users.csv");
    header("Pragma: no-cache");
    header("Expires: 0");

    $output = fopen("php://output", "w");
    foreach ($users as $user) {
        fputcsv($output, $user);
    }
    fclose($output);
    exit(0);

}

?>

<h2>Registered Users</h2>

<p>
    <a href="?page=users.php&download=1" class="btn btn-default">
        <i class="glyphicon glyphicon-download"></i>
        Download (.csv)
    </a>
</p>

<p>&nbsp;</p>

<table class="table table-bordered table-condensed table-striped">

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
