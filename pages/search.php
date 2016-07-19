<?php

/*
 * Prepare the search terms.
 * @param $terms The string from the user.
 * @return The string to search for.
 */
function prepareSearchTerms($terms) {
    $terms = ucwords($terms);  // Capitalise each word.
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
    <hr />


<?php } else { ?>

    <h2>Search our website</h2>
    <div class="alert alert-info">
        Please insert one or more search term(s) to search the website.
    </div>


<?php } ?>




<?php if ($query && !$resultsNo) { ?>
    <div class="alert alert-warning">
        Sorry, no article matched your search terms.
    </div>

<?php } elseif ($query) {

    // Show the list of search results.
    foreach ($results as $article) {
        include('./pages/fragments/article-preview.php');
    }

}

