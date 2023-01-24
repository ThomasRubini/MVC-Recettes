<?php

final class RecipeController
{

    public function viewAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        if(count($A_urlParams)!=1){
            throw new HTTPSpecialCaseException(404);
        }

        $O_recipeModel = new RecipeModel();
        $A_returnArray = $O_recipeModel->getFullRecipeWithApprs($A_urlParams[0]);
        if ($A_returnArray === null) {
            throw new HTTPSpecialCaseException(404);
        }

        $A_returnArray["ADMIN"] = Session::is_admin();

        View::show("recipe/view", $A_returnArray);

        // print_r($A_urlParams);
        // $O_recetteModel = new RecipeIngredientsModel();
        // $O_recetteModel->getByID("");
        // View::show('helloworld/testform', array('formData' =>  $A_postParams));

    }

    public function editAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::login_or_die();

        if(count($A_urlParams)!=1){
            throw new HTTPSpecialCaseException(404);
        }

        $O_recipeModel = new RecipeModel();
        $A_returnArray = $O_recipeModel->getFullRecipe($A_urlParams[0]);
        if ($A_returnArray === null) {
            throw new HTTPSpecialCaseException(404);
        }

        if ($A_returnArray["AUTHOR_ID"] !== $_SESSION["ID"]) {
            throw new HTTPSpecialCaseException(400, "You are not the owner of this recipe");
        }

        View::show("recipe/edit", $A_returnArray);
    }

    public function searchAction(Array $A_urlParams = null, Array $A_postParams = null, Array $A_getParams = null)
    {
        if (isset($A_getParams["query"])) {
            self::searchQueryView($A_urlParams, $A_postParams, $A_getParams);
        } else {
            self::searchView($A_urlParams, $A_postParams, $A_getParams);
        }
    }

    private function searchView(Array $A_urlParams = null, Array $A_postParams = null, Array $A_getParams = null)
    {
        View::show("recipe/search", array("QUERY" => null));
    }
    
    private function searchQueryView(Array $A_urlParams = null, Array $A_postParams = null, Array $A_getParams = null)
    {

        $O_recipeModel = new RecipeModel();
        $A_results = $O_recipeModel->searchRecipesByName($A_getParams["query"]);
        
        View::show("recipe/search", array(
            "QUERY" => $A_getParams["query"],
            "RESULTS" => $A_results,
        ));
    }

}
