<?php
$O_recipe = $A_view["RECIPE"];
?>
<a href="<?= $O_recipe->getLink() ?>">
    <img src="<?= $O_recipe->getImageLink() ?>" alt="<?= $O_recipe->S_NAME ?>">
    <section>
        <h2> <?= $O_recipe->S_NAME ?> </h2>
        <p> <?= $O_recipe->I_NOTE ?> </p>
    </section>
</a>
