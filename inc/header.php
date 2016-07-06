
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

    <script src="./js/jquey.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>

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
                <li><a href="?page=search.php"><i class="glyphicon glyphicon-search"></i>Search</a></li>
                <li><a href="?page=about.php"><i class="glyphicon glyphicon-info-sign"></i>About</a></li>
            </ul>
            
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

