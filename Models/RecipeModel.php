<?php

final class RecipeModel
{

    public function getRecipeByID($I_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT * FROM RECIPE WHERE ID=:id");
        $stmt->bindParam("id", $I_id);
        $stmt->execute();
        
        $row = $stmt->fetch();
        if ($row === false) return null;
        return $row;
    }

    public function getFullRecipeWithComments($I_id)
    {
        $A_recipe = self::getRecipeByID($I_id);
        if ($A_recipe === null)return null;
        
        $A_recipe["IMAGE_URL"] = "/static/img/recettes/".$A_recipe["ID"].".jpg";

        $O_ingredientModel = new IngredientModel();
        $A_recipe["INGREDIENTS"] = $O_ingredientModel->searchByRecipe($A_recipe["ID"]);

        $O_userModel = new UserModel();
        $A_recipe["AUTHOR_USERNAME"] = $O_userModel->getUsernameByID($A_recipe["AUTHOR_ID"]);
 
        $O_userModel = new DifficultyModel();
        $A_recipe["DIFFICULTY_NAME"] = $O_userModel->getByID($A_recipe["DIFFICULTY_ID"]);

        return $A_recipe;
    }
}
