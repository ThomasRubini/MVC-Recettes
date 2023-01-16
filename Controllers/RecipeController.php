<?php

final class RecipeController
{

    public function viewAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        if(count($A_urlParams)!=1){
            return View::show("errors/404");
        }
        
        $O_recipeModel = new RecipeModel();
        $A_returnArray = $O_recipeModel->getFullRecipeWithComments($A_urlParams[0]);
        if ($A_returnArray === null) {
            return View::show("errors/404");
        }

        View::show("recipe/view", $A_returnArray);

        // print_r($A_urlParams);
        // $O_recetteModel = new RecipeIngredientsModel();
        // $O_recetteModel->getByID("");
        // View::show('helloworld/testform', array('formData' =>  $A_postParams));

    }

}