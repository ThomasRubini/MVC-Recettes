<?php

final class RecipeController
{

    public function viewAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        if(count($A_urlParams)!=1){
            echo "404";
            return;
        }
        
        $O_recipeModel = new RecipeModel();
        $O_recipe = $O_recipeModel->getByID($A_urlParams[0]);
        if($O_recipe === null){
            echo "404";
            return;
        }

        $O_ingredientModel = new IngredientModel();
        $A_ingredients = $O_ingredientModel->searchByRecipe($O_recipe["id"]);

        $O_userModel = new UserModel();
        $A_authorName = $O_userModel->getNameByID($O_recipe["author_id"]);

        $O_userModel = new DifficultyModel();
        $A_difficultyName = $O_userModel->getByID($O_recipe["difficulty_id"]);

        $A_returnArray = array(
            "recipe_name" => $O_recipe["name"],
            "recipe_desc" => $O_recipe["desc"],
            "author_name" => $A_authorName,
            "recipe_ingredients" => $A_ingredients,
            "difficulty_name" => $A_difficultyName,
        );

        View::show("recipe/view", $A_returnArray);

        // print_r($A_urlParams);
        // $O_recetteModel = new RecipeIngredientsModel();
        // $O_recetteModel->getByID("");
        // View::show('helloworld/testform', array('formData' =>  $A_postParams));

    }

}