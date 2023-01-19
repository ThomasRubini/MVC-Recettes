<?php
?>

<nav>
    <ul>
        <?php
        foreach ($A_view as $categoryName => $recipes) {
            echo '<li><section>
                <h1>'.$categoryName.'</h1>
                <ul>';
                    foreach ($recipes as $recipe) {
                        echo '<li>';
                            View::show("common/recipe", $recipe);
                        echo '</li>';
                    }
                echo '</ul>
            </section></li>';
        }
        ?>
    </ul>
</nav>
