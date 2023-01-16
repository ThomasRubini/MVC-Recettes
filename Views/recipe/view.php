<p> <?= $A_view["NAME"] ?> </p>
<p> Auteur: <?= $A_view["AUTHOR_NAME"] ?> </p>
<p> Difficulté: <?= $A_view["DIFFICULTY_NAME"] ?> </p>
<p> Ingrédients: </p>
<?php

foreach($A_view["INGREDIENTS"] as $i){
    echo "<p> {$i['name']}: {$i['quantity']} </p>";
}
?>