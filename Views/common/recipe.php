<?php
$O_recipe = $A_view["RECIPE"];
?>
<a class="recipe" href="<?= $O_recipe->getLink() ?>">
    <img src="<?= $O_recipe->getImgLink() ?>" alt="<?= $O_recipe->S_NAME ?>">
    <section>
        <h2> <?= $O_recipe->S_NAME ?> </h2>
        <p> <?= $O_recipe->queryNote() ?> </p>
    </section>
</a>
