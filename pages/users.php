<?php

if (!($user and $user["role"] == "staff")) {
    die("You are not authorised to access this page.");
}

$salted_list = (isset($_GET['salted']) && $_GET['salted']);
$default_salt = $db->quote($conf["password_default_salt"]);

if ($salted_list) {
    $fields = ["id", "username", "password", "salt", "role"];
    $extra_query = "salt <> $default_salt";

} else {
    $fields = ["id", "username", "password", "hint", "role"];
    $extra_query = "salt = $default_salt";
    $extra_query = "id >= 16";

}

$cs_fields = implode(', ', $fields);
$query = "SELECT $cs_fields FROM users WHERE $extra_query";
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
    fputcsv($output, $fields);
    foreach ($users as $user) {
        fputcsv($output, $user);
    }
    fclose($output);
    exit(0);

}

?>

<h2>Registered Users</h2>

<ul class="nav nav-tabs">
    <li role="presentation" <?php if (!$salted_list) {?>class="active"<?php }?>>
        <a href="?page=users.php&salted=0">Unsalted</a>
    </li>
    <li role="presentation" <?php if ($salted_list) {?>class="active"<?php }?>>
        <a href="?page=users.php&salted=1">Salted</a>
    </li>
</ul>

<p>&nbsp;</p>

<p>
    <a href="?page=users.php&download=1&salted=<?= (int) $salted_list; ?>" class="btn btn-default">
        <i class="glyphicon glyphicon-download"></i>
        Download (.csv)
    </a>
</p>


<table class="table table-bordered table-condensed table-striped">

    <thead>
        <th>ID</th>
        <th>Username</th>
        <th>Password Hash</th>
        <?php if ($salted_list) { ?>
            <th>Password Salt</th>

        <?php } else { ?>
            <th>Password Hint</th>

        <?php } ?>
        <th>Role</th>
    </thead>

    <?php foreach ($users as $user) { ?>
    <tr>
        <?php foreach ($user as $field) { ?>
            <td><?= $field; ?></td>
        <?php } ?>
    </tr>
    <?php } ?>

</table>
