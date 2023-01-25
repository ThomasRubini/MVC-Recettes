<?php

final class DefaultController
{

    public function defaultAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $A_recipes = RecipeModel::getRandomRecipes(3);

        View::show("home/view", array("RECIPES" => $A_recipes));
    }
}
