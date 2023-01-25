<?php

$A_recipe = $A_view["RECIPE"];

function getOrEmpty($A_Dict, $S_keyName) {
    if (isset($A_Dict[$S_keyName])) {
        return $A_Dict[$S_keyName];
    } else {
        if($S_keyName == "TYPE" || $S_keyName == "INGREDIENTS")
            return array();
        return "";
    }
}
?>

<main>

    <form action="<?= $A_view["POST_URI"] ?>" method="post">

        <label for="recipeImage">Entrez l'image de haut de page&nbsp;:</label>
        <input type="file" name="recipeImage" id="recipeImage" required>

        <label for="recipeName">Nom de la recette&nbsp;:</label>
        <input type="text" name="recipeName" id="recipeName" placeholder="Nom du plat" value="<?= getOrEmpty($A_recipe, "NAME") ?>" required>
        </br>
        <label for="recipeDescription">Description de la recette</label>
        </br>
        <textarea name="recipeDescription" id="recipeDescription"><?= getOrEmpty($A_recipe, "DESC") ?></textarea>

        <section>
            <h1>Informations alimentaires</h1>

            <label for="recipeFifficulte">Niveau de difficulé&nbsp;:</label>
            <select name="recipeDifficulty" id="recipeDifficulte" required>
                <option value="tresFacile" <?= getOrEmpty($A_recipe, "DIFFICULTY_NAME")=="Très facile"? 'selected="selected"' : "" ?> >Très facile</option>
                <option value="facile" <?= getOrEmpty($A_recipe, "DIFFICULTY_NAME")=="Facile"? 'selected="selected"' : "" ?>>Facile</option>
                <option value="moyen" <?= getOrEmpty($A_recipe, "DIFFICULTY_NAME")=="Moyen"? 'selected="selected"' : "" ?>>Moyen</option>
                <option value="difficile" <?= getOrEmpty($A_recipe, "DIFFICULTY_NAME")=="Difficle"? 'selected="selected"' : "" ?>>Difficile</option>
            </select>


            <legend>Particularités du plat&nbsp;:</legend>
            <input type="checkbox" name="part_Vegan" id="recipeVegan" <?= in_array("Végan", getOrEmpty($A_recipe, "TYPE"))? "checked":"" ?> >
            <label for="recipeVegan">Végan</label>
            <input type="checkbox" name="part_LactoseFree" id="recipeLactoseFree" <?= in_array("Sans lactose", getOrEmpty($A_recipe, "TYPE"))? "checked":"" ?> >
            <label for="recipeLactoseFree">Sans lactose</label>
            <input type="checkbox" name="part_GlutenFree" id="recipeGlutenFree" <?= in_array("Sans gluten", getOrEmpty($A_recipe, "TYPE"))? "checked":"" ?> >
            <label for="recipeGlutenFree">Sans gluten</label>

            </br>

            <label for="recipeTime">Temps de préparation&nbsp;:</label>
            <input type="number" name="recipeTime" id="recipeTime" min="5" max="1500" step="5" placeholder="Temps de préparation" value="<?= getOrEmpty($A_recipe, "TIME") ?>" required>
            <label for="recipeTime">minutes</label>

        </section>


        <section>

            <h1>Ingrédients</h1>

            <ul class="recipeIngredients">
                <?php
                $ingredients = getOrEmpty($A_recipe, "INGREDIENTS");
                if(sizeof($ingredients) > 0) {
                    $i = 1;
                    foreach($ingredients as $ingredient) {
                        echo '<li>
                            <label for="recipeIngredient'.$i.'">Ingrédient&nbsp;:</label>
                            <input type="text" name="recipeIngredient'.$i.'" id="recipeIngredient'.$i.'" placeholder="Farine" value="'.$ingredient["NAME"].'">
                            <label for="recipeQuantity'.$i.'">Quantité&nbsp;:</label>
                            <input type="text" name="recipeQuantity'.$i.'" id="recipeIngredient'.$i.'" placeholder="500g" value="'.$ingredient["QUANTITY"].'">
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
                    $preparation = getOrEmpty($A_recipe, "RECIPE");
                    if(!empty($preparation)) {
                        $steps = explode("\n", $preparation);
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
