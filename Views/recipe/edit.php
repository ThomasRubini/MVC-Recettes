<?php
$O_recipe = $A_view["RECIPE"];

if ($O_recipe === null) {
    $S_name = null;
    $I_time = null;
    $S_descr = null;
    $A_steps = array();
    $S_difficultyName = null;
    $A_parts = array();
    $A_ingredients = array();
} else {
    $S_name = $O_recipe->S_NAME;
    $I_time = $O_recipe->I_TIME;
    $S_descr = $O_recipe->S_DESCR;
    $A_steps = $O_recipe->getSteps();
    $S_difficultyName = $O_recipe->getDifficulty()->S_NAME;
    $A_parts = array(); // TODO
    $A_ingredients = $O_recipe->getIngredients();
}
?>

<main class="editRecipe">
    <?php
    if ($O_recipe !== null) { ?>
        <a href="/recipe/view/<?= $O_recipe->I_ID ?>">Retour</a>
    <?php } ?>


    <form action="<?= $A_view["POST_URI"] ?>" method="post">

        <label for="recipeImage">Ajoutez l'image de haut de page&nbsp;:</label>
        <input type="file" name="recipeImage" id="recipeImage">
        <label for="recipeName">Nom de la recette&nbsp;:</label>
        <input type="text" name="recipeName" id="recipeName" placeholder="Nom du plat" value="<?= $S_name ?>" required>
        <label for="recipeDescription">Description de la recette</label>
        <textarea name="recipeDescription" id="recipeDescription" placeholder="Faites une description appétissante ! 😋"><?= $S_descr ?></textarea>

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
            <label for="recipeVegan" class="labelParticularite">Végan</label>
            <input type="checkbox" name="part_LactoseFree" id="recipeLactoseFree" <?= in_array("Sans lactose", $A_parts)? "checked":"" ?> >
            <label for="recipeLactoseFree" class="labelParticularite">Sans lactose</label>
            <input type="checkbox" name="part_GlutenFree" id="recipeGlutenFree" <?= in_array("Sans gluten", $A_parts)? "checked":"" ?> >
            <label for="recipeGlutenFree" class="labelParticularite">Sans gluten</label>

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
                            <input type="text" name="recipeIngredientNamess[]" id="recipeIngredient'.$i.'" placeholder="Farine" value="'.$O_ingredient->S_NAME.'">
                            <label for="recipeQuantity'.$i.'">Quantité&nbsp;:</label>
                            <input type="text" name="recipeIngredientQuantities[]" id="recipeIngredient'.$i.'" placeholder="500g" value="'.$O_ingredient->S_QUANTITY.'">
                        </li>';
                        $i++;
                    }
                    echo '</ul>
                    <button type="button" id="recipeButtonIngrdientLess">-</button>';
                    $numberOfIngredients = $i-1;
                } else {
                    echo '<li>
                        <label for="recipeIngredient1">Ingrédient&nbsp;:</label>
                        <input type="text" name="recipeIngredientNames[]" id="recipeIngredient1" placeholder="Farine">
                        <label for="recipeQuantity1">Quantité&nbsp;:</label>
                        <input type="text" name="recipeIngredientQuantities[]" id="recipeIngredient1" placeholder="500g">
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
                    if (count($A_steps) === 0) {
                        echo '<li>
                        <label for="recipeInstruction1">Étape 1&nbsp;:</label>
                        <input type="text" name="recipeInstructions[]" id="recipeInstruction1" placeholder="Battre les oeufs et la farine dans un grand saladier.">
                        </li>
                        </ol>
                        <button type="button" disabled="disabled" id="recipeButtonInstructionLess">-</button>';
                        $numberOfInstructions = 1;
                    } else {
                        $i = 1;
                        foreach($A_steps as $S_step) {
                            echo '<li>
                                <label for="recipeInstruction'.$i.'">Étape '.$i.'&nbsp;:</label>
                                <input type="text" name="recipeInstructions[]" id="recipeInstruction'.$i.'" placeholder="Battre les oeufs et la farine dans un grand saladier." value="'.$S_step.'">
                            </li>';
                            $i++;
                        }
                        $numberOfInstructions = $i-1;
                        echo '</ol>
                        <button type="button" id="recipeButtonInstructionLess">-</button>';
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
            nextArray[e].setAttribute("for", "recipeInstruction"+numberOfInstructions);
            nextArray[e].textContent = "Étape "+numberOfInstructions+"\u00A0:";
        } else {
            nextArray[e].setAttribute("id", "recipeInstruction"+numberOfInstructions);
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
