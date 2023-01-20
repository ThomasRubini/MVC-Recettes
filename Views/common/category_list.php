<?php
$allCategory = array(
    "Type de cuisson" => "type_de_cuisson",
    "Temps de préparation" => "temps_de_preparation",
    "Difficulté" => "difficulte",
    "Végan" => "vegan",
    "Sans gluten" => "sans_gluten",
    "Sans lactose" => "sans_lactose");
?>

<aside>
    <ul>
        <li><h3>Catégories :</h3></li>
        <?php
        foreach($allCategory as $category => $category_path) {
            echo '<li><a href="/category#' . $category_path . '">'. $category . '</a></li>';
        }?>
    </ul>
</aside>
