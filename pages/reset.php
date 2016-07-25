<?php

if (isset($_GET['reset_db'])) {
    resetDatabase();
}

if (isset($_GET['reset_code'])) {
    resetCode();
}


?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <h2 class="text-danger">
            <i class="glyphicon glyphicon-warning-sign"></i>
            Danger Zone
        </h2>

        <p>From this page, you can:</p>

        <div class="row">

            <div class="col-md-6">
                <?php if (isset($_GET['reset_db'])) { ?>
                    <div class="alert alert-info">
                        <i class="glyphicon glyphicon-check"></i>
                        The application database has been reset.
                    </div>
                <?php } ?>
                <p>
                    <a  href="?page=reset.php&reset_db=1"
                        data-confirm="Are you sure?"
                        class="btn btn-block btn-danger">
                        <i class="glyphicon glyphicon-file"></i>
                        Reset Database
                    </a>
                </p>
                <p>This will delete any content generated in the last day from the database, including
                    all comments, new articles and users.</p>
            </div>


            <div class="col-md-6">
                <?php if (isset($_GET['reset_code'])) { ?>
                    <div class="alert alert-info">
                        <i class="glyphicon glyphicon-check"></i>
                        The application code has been reset.
                    </div>
                <?php } ?>
                <p>
                    <a  href="?page=reset.php&reset_code=1"
                        data-confirm="Are you sure?"
                        class="btn btn-block btn-danger">
                        <i class="glyphicon glyphicon-file"></i>
                        Reset Code
                    </a>
                </p>
                <p>This will discard any changes made to the application's code.</p>
                <p>App directory: <code><?= getcwd(); ?></code></p>

            </div>

        </div>

        <hr />

        <p>
            If you feel courageous, why don't you
            <a href="?page=reset.php&reset_code=1&reset_db=1&im_a_lion=rooarr"
               class="text-danger" data-confirm="Are you sure?">
                Reset both the code and the database
            </a>?
        </p>

    </div>


</div>
