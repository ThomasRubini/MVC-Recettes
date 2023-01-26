<?php
$allCategory = array(
    "Végan" => "vegan",
    "Végétarien" => "vegetarian",
    "Sans gluten" => "glutenLess",
    "Sans lactose" => "lactoseLess");
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
