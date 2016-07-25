<?php

if (isset($_GET['reset_db'])) {
    $entitiesRemovedNo = resetDatabase();
}

if (isset($_GET['reset_code'])) {
    $gitOutput = resetCode();
}


?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <h2 class="text-danger">
            <i class="glyphicon glyphicon-warning-sign"></i>
            Danger Zone
        </h2>

        <p>If you've made any changes to the application and you want to
            discard them, you can use the following options.</p>

        <hr />

        <div class="row">

            <div class="col-md-6">
                <?php if (isset($_GET['reset_db'])) { ?>
                    <div class="alert alert-info">
                        <i class="glyphicon glyphicon-check"></i>
                        The application database has been reset.
                        <?= $entitiesRemovedNo; ?> entities
                        have been removed.
                    </div>
                <?php } ?>
                <p>
                    <a  href="?page=reset.php&reset_db=1"
                        data-confirm="Are you sure?"
                        class="btn btn-block btn-danger">
                        <i class="glyphicon glyphicon-list"></i>
                        Reset Database
                    </a>
                </p>
                <p>This will delete any content generated in the database:</p>
                <ul>
                    <li>New comments;</li>
                    <li>New users.</li>
                </ul>
                <p>Sample content will be preserved.</p>
            </div>


            <div class="col-md-6">
                <?php if (isset($_GET['reset_code'])) { ?>
                    <div class="alert alert-info">
                        <i class="glyphicon glyphicon-check"></i>
                        The application code has been reset.
                        Git output:
                        <code>
                            <?= $gitOutput; ?>
                        </code>
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

                <?php if (getcwd() == '/vagrant') { ?>
                <div class="alert alert-warning">
                    You seem to be running the application in a Vagrant VM.
                    This won't work here.
                </div>
                <?php } ?>

            </div>

        </div>

        <hr />

        <p>
            If you feel courageous, why don't you
            <a href="?page=reset.php&reset_code=1&reset_db=1&im_a_lion=rooarr"
               class="text-danger" data-confirm="Are you sure?">
                reset both the code and the database</a>?
        </p>

    </div>


</div>
