<?php View::show("common/category_list") ?>

<main>

    <img src="<?= $A_view["IMG_LINK"] ?>" alt="Image d'illustration de la recette">

    <section class="infosRecette">
        <header>
            <h1><?= $A_view["NAME"] ?></h1>
            <p><?= $A_view["TIME"] ?>&nbsp;—&nbsp;<?= $A_view["DIFFICULTY_NAME"] ?></p>
        </header>
        <p><?= $A_view["DESC"] ?></p>
    </section>

    <section class="ingredientsRecette">
        <h2>Ingrédients</h2>
        <ul>
            <?php
                foreach($A_view["INGREDIENTS"] as $ingredient)
                    echo "<li> {$ingredient["NAME"]}: {$ingredient["QUANTITY"]} </li>";
            ?>
        </ul>
    </section>

    <section>
        <h2>Préparation</h2>
        <ol>
            <?php
                foreach(explode("\n", $A_view["RECIPE"]) as $instructions)
                    echo "<li>".$instructions."</li>";
            ?>
        </ol>
    </section>

    <p>By <?= $A_view["AUTHOR_USERNAME"] ?></p>

    <?php
        View::show(
            "appreciations/view_all",
            array(
                "APPRS" => $A_view["APPRS"],
                "ADMIN" => $A_view["ADMIN"]
            )
        );
    ?>

</main>
