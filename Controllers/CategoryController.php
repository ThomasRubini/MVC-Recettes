<?php

final class CategoryController
{

    public function defaultAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $A_vegeta = ParticularityModel::getByName("végétarien")->getRecipes();
        $A_vegan = ParticularityModel::getByName("végan")->getRecipes();
        $A_gluten = ParticularityModel::getByName("sans gluten")->getRecipes();
        $A_lactose = ParticularityModel::getByName("sans lactose")->getRecipes();
        
        $A_array_categories = array(
            "Végan" => $A_vegan,
            "Végétarien" => $A_vegeta,
            "Sans gluten" => $A_gluten,
            "Sans lactose" => $A_lactose
        );

        View::show("category/view", $A_array_categories);
    }

    public function lactoseLessAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $A_lactose = ParticularityModel::getByName("sans lactose")->getRecipes();
        
        $A_array_categories = array(
            "Sans lactose" => $A_lactose
        );

        View::show("category/view", $A_array_categories);
    }
    public function glutenLessAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $A_gluten = ParticularityModel::getByName("sans gluten")->getRecipes();
        
        $A_array_categories = array(
            "Sans gluten" => $A_gluten
        );

        View::show("category/view", $A_array_categories);
    }
    public function veganAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $A_vegan = ParticularityModel::getByName("végan")->getRecipes();
        
        $A_array_categories = array(
            "Végan" => $A_vegan
        );

        View::show("category/view", $A_array_categories);
    }

    public function vegetarianAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $A_vegeta = ParticularityModel::getByName("végétarien")->getRecipes();

        $A_array_categories = array(
            "Végétarien" => $A_vegeta
        );

        View::show("category/view", $A_array_categories);
    }

}
