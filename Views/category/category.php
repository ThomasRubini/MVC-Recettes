<?php
$array_recepies_Type_de_cuisson = array( //test
    array(
        "id" => "1",
        "nom" => "Quaso",
        "img" => "4.jpg",
        "note" => "4.5"
    ),
    array(
        "id" => "1",
        "nom" => "Quaso",
        "img" => "4.jpg",
        "note" => "4.5"
    ),
    array(
        "id" => "1",
        "nom" => "Quaso",
        "img" => "4.jpg",
        "note" => "4.5"
    )
);

$array_categories = array(
    "Type de cuisson" => $array_recepies_Type_de_cuisson,
    "Temps de préparation" => $array_recepies_Type_de_cuisson,
    "Difficulté" => $array_recepies_Type_de_cuisson,
    "Végan" => $array_recepies_Type_de_cuisson,
    "Sans gluten" => $array_recepies_Type_de_cuisson,
    "Sans lactose" => $array_recepies_Type_de_cuisson
);
?>

<nav>
    <ul>
        <?php
        foreach ($array_categories as $categoryName => $recipes) {
            echo '<li><section>
                <h1><?$key?></h1>
                <ul>';
                    foreach ($recipes as $recipe) {
                        echo '<li>';
                            View::show("common/recipe", $recipe);
                        echo '</li>';
                    }
                echo '</ul>
            </section></li>';
        }
        ?>
    </ul>
</nav>
