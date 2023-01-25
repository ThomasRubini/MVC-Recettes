<?php
    # Check presence of the search term query parameter, to avoid getting a warning as the input placeholder value
    $has_query = $A_view["QUERY"] !== null;
?>


<main>
    <?php View::show("common/category_list") ?>
    <article>
        <!-- Inclure les catégories -->
        <form method="GET" action="/recipe/search">
            <label for="query">Saisissez les termes à rechercher</label>
            <input id="query" type="text" name="query" placeholder="<?= $has_query ? $A_view["QUERY"] : "Votre recherche" ?>">
            <input type="submit" value="Rechercher">
        </form>
        <section>
            <?php
                if ($has_query) {
                    $search_results = $A_view["RESULTS"];
                    if (empty($search_results)) {
                        echo '<h2 class="no_results">Aucun résultat</h2>';
                        echo '<p class="no_results_description">Assurez-vous d\'avoir rentré correctement vos termes de recherche ou essayez des mots clefs différents.</p>';
                    } else {
                        foreach ($search_results as $key => $value) {
                            View::show("common/recipe", $value);
                        }
                    }
                }
            ?>
        </section>
    </article>
</main>
