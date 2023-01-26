<?php

final class CategoryController
{

    public function defaultAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $A_recipes = RecipeModel::getRandomRecipes(3);
        
        // TODO actually fill out by particularity instead
        $A_array_categories = array(
            "Végan" => $A_recipes,
            "Sans gluten" => $A_recipes,
            "Sans lactose" => $A_recipes
        );

        View::show("category/view", $A_array_categories);
    }

}
