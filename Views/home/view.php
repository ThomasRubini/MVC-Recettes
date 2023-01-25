<img src="static/img/bandeau.jpg" alt="Cook">


<main>
    <?php View::show("common/category_list") ?>
    <article>
        <section>
            <h1> Nos idées recettes: </h1>
            <?php
                foreach ($A_view as $recipe){
                    View::show("common/recipe", $recipe);
                }
            ?>
        </section>
    </article>
</main>
