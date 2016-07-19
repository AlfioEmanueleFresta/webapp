
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?= $conf['title']; ?></title>

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link href="navbar-static-top.css" rel="stylesheet">

    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/app.js"></script>

</head>

<body>

<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="?page=index.php">
                <?= $conf["title"]; ?>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="?page=index.php"><i class="glyphicon glyphicon-home"></i>Home</a></li>
                <li><a href="?page=about.php"><i class="glyphicon glyphicon-info-sign"></i>About</a></li>

                <?php if ($user && $user["role"] == "staff") { ?>
                    <li><a href="?page=users.php"><i class="glyphicon glyphicon-list"></i>Users list</a></li>
                <?php } ?>
            </ul>

            <form class="navbar-form navbar-left" role="search" method="GET" action="index.php">
                <input type="hidden" name="page" value="search.php" />
                <div class="form-group">
                    <input  type="text" class="form-control"
                            value="<?= @htmlentities($_GET['q']); ?>"
                            placeholder="Search for..."
                            name="q" <?= isset($_GET['q']) ? 'autofocus' : ''; ?>
                    >
                </div>
                <button type="submit" class="btn btn-default" title="Search">
                    <i class="glyphicon glyphicon-search"></i>
                    <span class="sr-only">Search</span>
                </button>
            </form>

            <ul class="nav navbar-nav navbar-right">

                <?php if ($user) { ?>
                    <li class="active"><a href="#">Hi, <strong><?= $user["username"]; ?></strong> (role: <?= $user["role"]; ?>)</a></li>
                    <li><a href="?page=logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>

                <?php } else { ?>
                    <li><a href="?page=login.php"><i class="glyphicon glyphicon-log-in"></i> Login</a></li>
                    <li><a href="?page=register.php"><i class="glyphicon glyphicon-asterisk"></i> Register</a></li>

                <?php } ?>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>


<div class="container">


    <?php if (isset($_GET['logged_out'])) { ?>
        <div class="alert alert-info">
            <i class="glyphicon glyphicon-info-sign"></i>
            You have been successfully logged out.
            <a class="close-button pull-right">Close</a>
        </div>
    <?php } ?>

    <?php if (isset($_GET['logged_in']) && $user) { ?>
        <div class="alert alert-success">
            <i class="glyphicon glyphicon-check"></i>
            Login successful. Welcome back, <?= $user['username']; ?>!
            <a class="close-button pull-right">Close</a>
        </div>
    <?php } ?>

