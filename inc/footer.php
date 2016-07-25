
            <p>&nbsp; <!-- Some spacing --></p>
            <hr />
            <footer class="row">
                <div class="col-md-6">
                    &copy;<?= date('Y'); ?> <?= $conf['title']; ?>.
                </div>
                <div class="col-md-6" style="text-align: right;">
                    You can
                    <a href="?page=reset.php" class="text-danger">
                        <i class="glyphicon glyphicon-refresh"></i>
                        reset any changes
                    </a>
                    made to the application.

                </div>
            </footer>
        </div>
    </body>
</html>
