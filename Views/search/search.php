<?php
    # Check presence of the search term query parameter, to avoid getting a warning as the input placeholder value
    $has_search_term = $A_view["search_term"] === null;
?>
<main>
    <!-- Inclure les catégories -->
    <?php View::show("common/category_list") ?>
    <form method="GET" action="search">
        <label for="search_term">Saisissez les termes à rechercher</label>
        <input id="search_term" type="text" name="search_term" placeholder="<?= $has_search_term ? $A_view["search_term"] : "Votre recherche" ?>">
        <input type="submit" value="Rechercher">
    </form>
    <section>
        <?php
            $search_results = $A_view["results"];
            if (empty($search_results)) {
                echo '<h2 class="no_results">Aucun résultat</h2>';
                echo '<p class="no_results_description">Assurez-vous d\'avoir rentré correctement vos termes de recherche ou essayez des mots clefs différents.</p>';
            } else {
                foreach ($search_results as $key => $value) {
                    View::show("common/recipe", $value);
                }
            }
        ?>
    </section>
</main>
