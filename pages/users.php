<?php

if (!($user and $user["role"] == "staff")) {
    die("You are not authorised to access this page.");
}

$default_salt = $db->quote($conf["password_default_salt"]);
$lists = [
    'unsalted' => [
        'fields' => ["id", "username", "password_hash", "hint", "role"],
        'heading' => ["ID", "Username", "Password Hash", "Password Hint", "Role"],
        'extra_query' => "salt = $default_salt AND password IS NULL",
        'title' => 'Unsalted hash passwords',
    ],
    'salted' => [
        'fields' => ["id", "username", "password_hash", "salt", "role"],
        'heading' => ["ID", "Username", "Password Hash", "Password Salt", "Role"],
        'extra_query' => "salt <> $default_salt AND password IS NULL",
        'title' => 'Salted hash passwords',
    ],
    'plain_text' => [
        'fields' => ["id", "username", "password", "hint", "role"],
        'heading' => ["ID", "Username", "Password", "Password Hint", "Role"],
        'extra_query' => "PASSWORD IS NOT NULL",
        'title' => 'Plain-text passwords',
    ],
];

$default_list = 'unsalted';
$current_list = isset($_GET['list']) && isset($lists[$_GET['list']]) ? $_GET['list'] : $default_list;

$cs_fields = implode(', ', $lists[$current_list]['fields']);
$extra_query = $lists[$current_list]['extra_query'];
$query = "SELECT $cs_fields FROM users WHERE $extra_query";
$query = $db->query($query);
$query->execute();

$users = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['download'])) {

    ob_clean();
    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename=users_$current_list.csv");
    header("Pragma: no-cache");
    header("Expires: 0");

    $output = fopen("php://output", "w");
    fputcsv($output, $lists[$current_list]['fields']);
    foreach ($users as $user) {
        fputcsv($output, $user);
    }
    fclose($output);
    exit(0);

}

?>

<h2>Registered Users</h2>

<ul class="nav nav-tabs">

    <?php foreach ($lists as $key => $value) { ?>
        <li role="presentation" <?php if ($current_list == $key) {?>class="active"<?php }?>>
            <a href="?page=users.php&list=<?= $key; ?>"><?= $value['title']; ?></a>
        </li>
    <?php } ?>

</ul>

<p>&nbsp;</p>

<p>
    <a href="?page=users.php&download=1&list=<?= $current_list; ?>" class="btn btn-default">
        <i class="glyphicon glyphicon-download"></i>
        Download (.csv)
    </a>
</p>


<table class="table table-bordered table-condensed table-striped">

    <thead>
        <?php foreach($lists[$current_list]['heading'] as $c) { ?>
            <th><?= $c; ?></th>
        <?php } ?>
    </thead>

    <?php foreach ($users as $user) { ?>
    <tr>
        <?php foreach ($user as $field) { ?>
            <td><?= $field; ?></td>
        <?php } ?>
    </tr>
    <?php } ?>

</table>
