<?php

final class IngredientModel
{

    public function searchByRecipe($I_recipe_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("
        SELECT * FROM INGREDIENT
        JOIN RECIPE_INGREDIENT ON RECIPE_INGREDIENT.INGREDIENT_ID=INGREDIENT.ID
        WHERE RECIPE_INGREDIENT.RECIPE_ID = :recipe_id
        ");
        $stmt->bindParam("recipe_id", $I_recipe_id);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
}
