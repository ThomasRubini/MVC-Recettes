<?php

final class RecipeController
{

    public function viewAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        if(count($A_urlParams)!=1){
            throw new HTTPSpecialCaseException(404);
        }

        //TODO MAKE THE VIEW USE THE NEW DATA FORMAT
        $O_recipe = RecipeModel::getFullRecipeWithApprs($A_urlParams[0]);
        if ($O_recipe === null) {
            throw new HTTPSpecialCaseException(404);
        }

        View::show("recipe/view", array(
            "ADMIN" => Session::is_admin(),
            "RECIPE" => $O_recipe
        ));
    }

    public function editAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::login_or_die();

        if(count($A_urlParams)!=1){
            throw new HTTPSpecialCaseException(404);
        }

        
        $O_recipe = RecipeModel::getFullRecipeById($A_urlParams[0]);
        if ($O_recipe === null) {
            throw new HTTPSpecialCaseException(404);
        }

        if ($O_recipe->I_AUTHOR_ID !== $_SESSION["ID"]) {
            if(!Session::is_admin()){
                throw new HTTPSpecialCaseException(400, "You are not the owner of this recipe");
            }
        }
        //TODO MAKE THE VIEW USE THE NEW DATA FORMAT
        View::show("recipe/edit", array("POST_URI" => "/recipe/update", "RECIPE" => $O_recipe));
    }

    public function newAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::login_or_die();
        
        View::show("recipe/edit", array("POST_URI" => "/recipe/create", "RECIPE" => array()));
    }

    public function createAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::login_or_die();

        $O_difficulty = DifficultyModel::getByName($A_postParams["recipeDifficulty"]);
        if($O_difficulty === null){
            throw new HTTPSpecialCaseException(400, "Invalid difficulty");
        }

        $O_recipe = new RecipeModel(
            $A_postParams["recipeName"], $A_postParams["recipeTime"], $A_postParams["recipeDescription"],
            null, $O_difficulty->I_ID, $_SESSION["ID"]
        );
        $O_recipe->insert();

        header("Location: /recipe/view/".$O_recipe->I_ID);
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

        //TODO change this when the function will return object array
        $A_results = RecipeModel::searchRecipesByName($A_getParams["query"]);
        
        View::show("recipe/search", array(
            "QUERY" => $A_getParams["query"],
            "RESULTS" => $A_results,
        ));
    }

    public function imgAction(Array $A_urlParams = null, Array $A_postParams = null, Array $A_getParams = null)
    {
        if (count($A_urlParams) !== 1 ) throw new HTTPSpecialCaseException(404);

        
        $O_recipe = RecipeModel::getRecipeByID($A_urlParams[0]);

        header("Content-Type: image");
        if (isset($O_recipe)) {
            $S_img = $O_recipe->queryImg();
            if ($S_img !== null) {
                echo $S_img;
                return Utils::RETURN_RAW;
            }
        }
        
        echo file_get_contents(Constants::rootDir()."/static/img/default_recipe.jpg");
        return Utils::RETURN_RAW;
    }
}
