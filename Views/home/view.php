<img src="static/img/bandeau.jpg" alt="Cook">

<?php View::show("common/category_list") ?>

<main>
    <section>
        <h1> Nos idées recettes: </h1>
        <?php
            foreach ($A_view as $recipe){
                View::show("common/recipe", $recipe);
            }
        ?>
    </section>
</main>
