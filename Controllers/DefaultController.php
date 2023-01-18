<?php

final class DefaultController
{

    public function defaultAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $array_recipes = array(
            array(
                "LINK" => "/recipe/view/1",
                "NAME" => "Pâte à crêpe",
                "IMG" => "/static/img/recipes/1.jpg",
                "NOTE" => "4.5"
            ),
            array(
                "LINK" => "/recipe/view/1",
                "NAME" => "Pâte à crêpe",
                "IMG" => "/static/img/recipes/1.jpg",
                "NOTE" => "4.5"
            ),
            array(
                "LINK" => "/recipe/view/1",
                "NAME" => "Pâte à crêpe",
                "IMG" => "/static/img/recipes/1.jpg",
                "NOTE" => "4.5"
            ),
        );
        View::show("home/view", $array_recipes);
    }
}
