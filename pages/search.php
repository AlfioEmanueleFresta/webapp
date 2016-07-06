<?php

/*
 * Prepare the search terms.
 * @param $terms The string from the user.
 * @return The string to search for.
 */
function prepareSearchTerms($terms) {
    $terms = strtolower($terms);
    return $terms;
}

$query = prepareSearchTerms(@$_GET['q']);

if ($query) {
    $results = searchArticles($query);
    $resultsNo = count($results);
}

?>

<?php if ($query) { ?>
    <h2>
        <?= $resultsNo; ?> results found for "<?= $query; ?>"
    </h2>

<?php } else { ?>
    <h2>Search our website</h2>

<?php } ?>

<form method="GET">
    <input type="hidden" name="page" value="search.php" />

    <div class="input-group">
        <input type="text" name="q" value="<?= $query; ?>" autofocus
               class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">
            <i class="glyphicon glyphicon-search"></i>
            Search
        </button>
      </span>
    </div><!-- /input-group -->

</form>


<?php if ($query && !$resultsNo) { ?>
    <p>Sorry, no article matched your search terms.</p>

<?php } elseif ($query) { ?>

    <!-- Show the list of search results. -->
    <ul>
        <?php foreach ($results as $result) { ?>
            <li>
                <a href="?p=read.php&id=<?= $result["id"]; ?>">
                    <?= $result["title"]; ?>
                </a>
            </li>

        <?php } ?>
    </ul>

<?php } ?>

