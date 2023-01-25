<?php
$O_recipe = $A_view["RECIPE"];

if ($O_recipe === null) {
    $S_name = null;
    $I_time = null;
    $S_descr = null;
    $S_recipe = null;
    $S_difficultyName = null;
    $A_parts = array();
    $A_ingredients = array();
} else {
    $S_name = $O_recipe->S_NAME;
    $I_time = $O_recipe->I_TIME;
    $S_descr = $O_recipe->S_DESCR;
    $S_recipe = $O_recipe->S_RECIPE;
    $S_difficultyName = $O_recipe->getDifficulty()->S_NAME;
    $A_parts = array(); // TODO
    $A_ingredients = $O_recipe->getIngredients();
}
?>

<main>

    <form action="<?= $A_view["POST_URI"] ?>" method="post">

        <label for="recipeImage">Entrez l'image de haut de page&nbsp;:</label>
        <input type="file" name="recipeImage" id="recipeImage">

        <label for="recipeName">Nom de la recette&nbsp;:</label>
        <input type="text" name="recipeName" id="recipeName" placeholder="Nom du plat" value="<?= $S_name ?>" required>
        </br>
        <label for="recipeDescription">Description de la recette</label>
        </br>
        <textarea name="recipeDescription" id="recipeDescription"><?= $S_descr ?></textarea>

        <section>
            <h1>Informations alimentaires</h1>

            <label for="recipeFifficulte">Niveau de difficulé&nbsp;:</label>
            <select name="recipeDifficulty" id="recipeDifficulte" required>
                <?php
                $A_difficulties = array("Très facile", "Facile", "Moyen", "Difficile");
                foreach($A_difficulties as $S_difficulty){?>
                    <option value="<?=$S_difficulty?>" <?= $S_difficultyName===$S_difficulty? 'selected="selected"' : "" ?> ><?=$S_difficulty?></option>
                <?php } ?>
            </select>


            <legend>Particularités du plat&nbsp;:</legend>
            <input type="checkbox" name="part_Vegan" id="recipeVegan" <?= in_array("Végan", $A_parts)? "checked":"" ?> >
            <label for="recipeVegan">Végan</label>
            <input type="checkbox" name="part_LactoseFree" id="recipeLactoseFree" <?= in_array("Sans lactose", $A_parts)? "checked":"" ?> >
            <label for="recipeLactoseFree">Sans lactose</label>
            <input type="checkbox" name="part_GlutenFree" id="recipeGlutenFree" <?= in_array("Sans gluten", $A_parts)? "checked":"" ?> >
            <label for="recipeGlutenFree">Sans gluten</label>

            </br>

            <label for="recipeTime">Temps de préparation&nbsp;:</label>
            <input type="number" name="recipeTime" id="recipeTime" min="5" max="1500" step="5" placeholder="Temps de préparation" value="<?= $I_time ?>" required>
            <label for="recipeTime">minutes</label>

        </section>


        <section>

            <h1>Ingrédients</h1>

            <ul class="recipeIngredients">
                <?php
                if(sizeof($A_ingredients) > 0) {
                    $i = 1;
                    foreach($A_ingredients as $O_ingredient) {
                        echo '<li>
                            <label for="recipeIngredient'.$i.'">Ingrédient&nbsp;:</label>
                            <input type="text" name="recipeIngredient'.$i.'" id="recipeIngredient'.$i.'" placeholder="Farine" value="'.$O_ingredient["NAME"].'">
                            <label for="recipeQuantity'.$i.'">Quantité&nbsp;:</label>
                            <input type="text" name="recipeQuantity'.$i.'" id="recipeIngredient'.$i.'" placeholder="500g" value="'.$O_ingredient["QUANTITY"].'">
                        </li>';
                        $i++;
                    }
                    echo '</ul>
                    <button type="button" id="recipeButtonIngrdientLess">-</button>';
                    $numberOfIngredients = $i-1;
                } else {
                    echo '<li>
                        <label for="recipeIngredient1">Ingrédient&nbsp;:</label>
                        <input type="text" name="recipeIngredient1" id="recipeIngredient1" placeholder="Farine">
                        <label for="recipeQuantity1">Quantité&nbsp;:</label>
                        <input type="text" name="recipeQuantity1" id="recipeIngredient1" placeholder="500g">
                        </li>
                    </ul>
                    <button type="button" disabled="disabled" id="recipeButtonIngrdientLess">-</button>';
                    $numberOfIngredients = 1;
                }
                ?>
            <button type="button" id="recipeButtonIngredientPlus">+</button>

        </section>


        <section>

            <h1>Préparation</h1>

            <ol class="recipeInstructions">
                <?php
                    if(!empty($S_recipe)) {
                        $steps = explode("\n", $S_recipe);
                        $i = 1;
                        foreach($steps as $step) {
                            echo '<li>
                                <label for="recipeInstruction'.$i.'">Étape '.$i.'&nbsp;:</label>
                                <input type="text" name="recipeInstruction'.$i.'" id="recipeInstruction'.$i.'" placeholder="Battre les oeufs et la farine dans un grand saladier." value="'.$step.'">
                            </li>';
                            $i++;
                        }
                        $numberOfInstructions = $i-1;
                        echo '</ol>
                        <button type="button" id="recipeButtonInstructionLess">-</button>';
                    } else {
                        echo '<li>
                            <label for="recipeInstruction1">Étape 1&nbsp;:</label>
                            <input type="text" name="recipeInstruction1" id="recipeInstruction1" placeholder="Battre les oeufs et la farine dans un grand saladier.">
                        </li>
                    </ol>
                    <button type="button" disabled="disabled" id="recipeButtonInstructionLess">-</button>';
                    $numberOfIngredients = 1;
                    }
                ?>
            <button type="button" id="recipeButtonInstructionPlus">+</button>


        </section>

        <input type="submit" value="Enregistrer">

    </form>

</main>

<script>
numberOfIngredients = <?= $numberOfIngredients ?>;
const buttonIngredientPlus = document.querySelector("#recipeButtonIngredientPlus");
const buttonIngredientLess = document.querySelector("#recipeButtonIngrdientLess");
const liIngredients = document.querySelector(".recipeIngredients");

buttonIngredientPlus.addEventListener('click', () => {
    numberOfIngredients++;
    let nextArray = Array.from(liIngredients.lastElementChild.cloneNode(true).children);
    let next = document.createElement('li');

    for(let e in nextArray) {
        console.log(nextArray[e]);
        if(nextArray[e].tagName == "LABEL") {
            nextArray[e].setAttribute("for", "recipeIngredient"+numberOfIngredients);
        } else {
            nextArray[e].setAttribute("name", "recipeIngredient"+numberOfIngredients);
            nextArray[e].setAttribute("id", "recipeIngredient"+numberOfIngredients);
            nextArray[e].value = "";
        }
        next.appendChild(nextArray[e]);
    }

    console.log(next);

    liIngredients.appendChild(next);
    buttonIngredientLess.disabled = "";
});

buttonIngredientLess.addEventListener('click', () => {
    numberOfIngredients--;
    liIngredients.lastElementChild.remove();
    if(liIngredients.children.length == 1)
        buttonIngredientLess.disabled = "disabled";
});


numberOfInstructions = <?= $numberOfInstructions ?>;
const buttonInstructionPlus = document.querySelector("#recipeButtonInstructionPlus");
const buttonInstructionLess = document.querySelector("#recipeButtonInstructionLess");
const liInstruction = document.querySelector(".recipeInstructions");

buttonInstructionPlus.addEventListener('click', () => {
    numberOfInstructions++;
    let nextArray = Array.from(liInstruction.lastElementChild.cloneNode(true).children);
    let next = document.createElement('li');

    for(let e in nextArray) {
        console.log(nextArray[e]);
        if(nextArray[e].tagName == "LABEL") {
            nextArray[e].setAttribute("for", "recipeIngredient"+numberOfInstructions);
            nextArray[e].textContent = "Étape "+numberOfInstructions+"\u00A0:";
        } else {
            nextArray[e].setAttribute("name", "recipeIngredient"+numberOfInstructions);
            nextArray[e].setAttribute("id", "recipeIngredient"+numberOfInstructions);
            nextArray[e].value = "";
        }
        next.appendChild(nextArray[e]);
    }

    console.log(next);

    liInstruction.appendChild(next);
    buttonInstructionLess.disabled = "";
});

buttonInstructionLess.addEventListener('click', () => {
    numberOfInstructions--;
    liInstruction.lastElementChild.remove();
    if(liInstruction.children.length == 1)
        buttonInstructionLess.disabled = "disabled";
});
// TODO: refactor this
</script>
