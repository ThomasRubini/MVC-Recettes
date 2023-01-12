<p> <?= $A_view["recipe_name"] ?> </p>
<p> Auteur: <?= $A_view["author_name"] ?> </p>
<p> Difficulté: <?= $A_view["difficulty_name"] ?> </p>
<p> Ingrédients: </p>
<?php

foreach($A_view["recipe_ingredients"] as $i){
    echo "<p> {$i['name']}: {$i['quantity']} </p>";
}
?>