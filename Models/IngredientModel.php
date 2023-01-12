<?php

final class IngredientModel
{

    public function searchByRecipe($I_recipe_id)
    {
        return array(
            array(
                "id" => 1,
                "name" => "oeuf",
                "quantity" => "6",
            ),
            array(
                "id" => 2,
                "name" => "lait",
                "quantity" => "1/2L",
            ),
        );
    }
}
