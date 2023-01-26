<?php
$allCategory = array(
    "Type de cuisson" => "type_de_cuisson",
    "Temps de préparation" => "temps_de_preparation",
    "Difficulté" => "difficulte",
    "Végan" => "vegan",
    "Sans gluten" => "sans_gluten",
    "Sans lactose" => "sans_lactose"
);
?>

<main class="hasAside">
    <?= View::show("common/category_list"); ?>
    <article>
        <?php
        foreach ($A_view as $categoryName => $A_recipes) {
            echo '<section id="'.$allCategory[$categoryName].'">
                <h1>'.$categoryName.'</h1>
                <ul>';
                    foreach ($A_recipes as $O_recipe) {
                        echo '<li>';
                            View::show("common/recipe", array("RECIPE" => $O_recipe));
                        echo '</li>';
                    }
                echo '</ul>
            </section>';
        }
        ?>
    </article>
</main>
