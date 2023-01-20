<?php
$allCategory = array(
    "Type de cuisson" => "type_de_cuisson",
    "Temps de préparation" => "temps_de_preparation",
    "Difficulté" => "difficulte",
    "Végan" => "vegan",
    "Sans gluten" => "sans_gluten",
    "Sans lactose" => "sans_lactose");
?>

<main>
    <?php
    foreach ($A_view as $categoryName => $recipes) {
        echo '<section id="'.$allCategory[$categoryName].'">
            <h1>'.$categoryName.'</h1>
            <ul>';
                foreach ($recipes as $recipe) {
                    echo '<li>';
                        View::show("common/recipe", $recipe);
                    echo '</li>';
                }
            echo '</ul>
        </section>';
    }
    ?>
</main>
