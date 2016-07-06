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

$query = prepareSearchTerms($_GET['q']);

$results = searchArticles($query);
$resultsNo = count($results);

?>

<h2>
    <?= $resultsNo; ?> results found for "<?= $query; ?>"
</h2>

<?php if (!$resultsNo) { ?>
    <p>Sorry, no article matched your search terms.</p>

<?php } else { ?>

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

