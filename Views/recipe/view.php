<?php
$O_recipe = $A_view["RECIPE"];
?>
<main class="hasAside recipeView">
    <?php View::show("common/category_list") ?>
    <article>
        <img src="<?= $O_recipe->getImgLink() ?>" alt="Image d'illustration de la recette">

        <section class="infosRecette">
            <header>
                <h1><?= $O_recipe->S_NAME ?></h1>
                <p><?= $O_recipe->I_TIME ?>&nbsp;—&nbsp;<?= $O_recipe->getDifficulty()->S_NAME ?></p>
            </header>
            <p><?= $O_recipe->S_DESCR ?></p>
        </section>

        <section class="ingredientsRecette">
            <h2>Ingrédients</h2>
            <ul>
                <?php
                    foreach($O_recipe->getIngredients() as $O_ingredient){
                        echo "<li> $O_ingredient->S_NAME: $O_ingredient->S_QUANTITY </li>";
                    }
                ?>
            </ul>
        </section>

        <section>
            <h2>Préparation</h2>
            <ol>
                <?php
                    foreach($O_recipe->getSteps() as $S_instr)
                        echo "<li>".$S_instr."</li>";
                ?>
            </ol>
        </section>

        <?php
        $O_author = $O_recipe->getAuthor();
        if($O_author === null) {
            echo '<p>By an anonymous user</p>';
        } else {
            echo '<p>By '.$O_author->S_USERNAME.' </p>';
        }
        ?>

        <section class="buttonsEditRecipe">
            <a href="/recipe/edit/<?= $O_recipe->I_ID ?>">Modifier la recette</a>
            <a href="/recipe/delete/<?= $O_recipe->I_ID ?>">Supprimer la recette</a>
        </section>

        <?php
            View::show("appreciations/view_all", $A_view)
        ?>
    </article>

</main>
