<?php

final class CategoriesController
{

    public function defaultAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $A_array_recipes_Type_de_cuisson = array( //test
            array(
                "id" => "1",
                "nom" => "Quaso",
                "img" => "4.jpg",
                "note" => "4.5"
            ),
            array(
                "id" => "1",
                "nom" => "Quaso",
                "img" => "4.jpg",
                "note" => "4.5"
            ),
            array(
                "id" => "1",
                "nom" => "Quaso",
                "img" => "4.jpg",
                "note" => "4.5"
            )
        );
        
        $A_array_categories = array(
            "Type de cuisson" => $A_array_recipes_Type_de_cuisson,
            "Temps de préparation" => $A_array_recipes_Type_de_cuisson,
            "Difficulté" => $A_array_recipes_Type_de_cuisson,
            "Végan" => $A_array_recipes_Type_de_cuisson,
            "Sans gluten" => $A_array_recipes_Type_de_cuisson,
            "Sans lactose" => $A_array_recipes_Type_de_cuisson
        );

        View::show("category/view", $A_array_categories);
    }
    
}
