<?php
$O_recipe = $A_view["RECIPE"];
?>
<main>
    <?php View::show("common/category_list") ?>
    <article>
        <img src="<?= $O_recipe->getImgLink() ?>" alt="Image d'illustration de la recette">

        <section class="infosRecette">
            <header>
                <h1><?= $O_recipe->S_NAME ?></h1>
                <p><?= $O_recipe->I_TIME ?>&nbsp;—&nbsp;<?= $O_recipe->O_DIFFICULTY->S_NAME ?></p>
            </header>
            <p><?= $O_recipe->S_DESC ?></p>
        </section>

        <section class="ingredientsRecette">
            <h2>Ingrédients</h2>
            <ul>
                <?php
                    foreach($O_recipe->getIngredients() as $O_ingredient){
                        echo "<li> $O_ingredient->S_NAME: $O_ingredient->I_QUANTITY </li>";
                    }
                ?>
            </ul>
        </section>

        <section>
            <h2>Préparation</h2>
            <ol>
                <?php
                    foreach(explode("\n", $O_recipe->S_RECIPE) as $S_instr)
                        echo "<li>".$S_instr."</li>";
                ?>
            </ol>
        </section>

        <p>By <?= $O_recipe->getAuthor()->S_USERNAME ?></p>

        <?php
            View::show("appreciations/view_all", $A_view)
        ?>
    </article>

</main>
