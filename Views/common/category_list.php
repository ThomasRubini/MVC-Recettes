<?php
$allCategory = array(
    "Végan" => "vegan",
    "Végetérien" => "vegetarian",
    "Sans gluten" => "glutenLess",
    "Sans lactose" => "lactoseLess",
    "Non Catégorisé" => "uncategorized");
?>

<aside>
    <ul>
        <li class="hasH3"><h3>Catégories :</h3></li>
        <?php
        foreach($allCategory as $category => $category_path) {
            echo '<li><a href="/category#' . $category_path . '">'. $category . '</a></li>';
        }?>
    </ul>
</aside>
