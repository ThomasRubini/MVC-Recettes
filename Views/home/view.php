<?php
$array_recipes = array(
    array(
        "nom" => "Quaso",
        "img" => "4.jpg",
        "note" => "4.5"
    ),
    array(
        "nom" => "Quaso",
        "img" => "4.jpg",
        "note" => "4.5"
    ),
    array(
        "nom" => "Quaso",
        "img" => "4.jpg",
        "note" => "4.5"
    ),
);
?>

<img src="static/img/bandeau.jpg" alt="Cook">

<section>
    <h1> idées recettes: </h1>
    <section>
        <?php
            foreach ($array_recipes as $recipe){
                View::show("common/recipe", $recipe);
            }
        ?>
    </section>
</section>


