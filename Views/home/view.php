<img src="static/img/bandeau.jpg" alt="Cook">


<main class="hasAside">
    <?php View::show("common/category_list") ?>
    <article>
        <section>
            <h1> Nos idées recettes: </h1>
            <ul>
                <?php
                    foreach ($A_view["RECIPES"] as $O_recipe){
                        echo '<li>';
                        View::show("common/recipe", array("RECIPE" => $O_recipe));
                        echo '</li>';
                    }
                ?>
            </ul>
        </section>
    </article>
</main>
