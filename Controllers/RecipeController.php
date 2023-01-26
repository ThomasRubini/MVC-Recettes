<?php

final class RecipeController
{

    public function viewAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        if(count($A_urlParams)!=1){
            throw new HTTPSpecialCaseException(404);
        }

        //TODO MAKE THE VIEW USE THE NEW DATA FORMAT
        $O_recipe = RecipeModel::getByID($A_urlParams[0]);
        if ($O_recipe === null) {
            throw new HTTPSpecialCaseException(404);
        }

        View::show("recipe/view", array(
            "ADMIN" => Session::is_admin(),
            "USER_ID" => Session::is_login() ? $_SESSION["ID"] : null,
            "RECIPE" => $O_recipe
        ));
    }

    public function editAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::login_or_die();

        if(count($A_urlParams)!=1){
            throw new HTTPSpecialCaseException(404);
        }

        
        $O_recipe = RecipeModel::getByID($A_urlParams[0]);
        if ($O_recipe === null) {
            throw new HTTPSpecialCaseException(404);
        }

        if ($O_recipe->I_AUTHOR_ID !== $_SESSION["ID"]) {
            if(!Session::is_admin()){
                throw new HTTPSpecialCaseException(400, "You are not the owner of this recipe");
            }
        }
        
        View::show("recipe/edit", array("POST_URI" => "/recipe/update/".$O_recipe->I_ID, "RECIPE" => $O_recipe));
    }

    public function newAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::login_or_die();
        
        View::show("recipe/edit", array("POST_URI" => "/recipe/create", "RECIPE" => null));
    }

    private static function fillRecipeFromPostParams($O_recipe, Array $A_postParams)
    {
        $O_difficulty = DifficultyModel::getByName(Utils::getOrDie($A_postParams, "recipeDifficulty"));
        if($O_difficulty === null){
            throw new HTTPSpecialCaseException(400, "Invalid difficulty");
        }

        $O_recipe->S_NAME = Utils::getOrDie($A_postParams, "recipeName");
        $O_recipe->I_TIME = Utils::intOrDie(Utils::getOrDie($A_postParams, "recipeTime"));
        $O_recipe->S_DESCR = Utils::getOrDie($A_postParams, "recipeDescription");
        $O_recipe->I_DIFFICULTY_ID = $O_difficulty->I_ID;
        $O_recipe->I_AUTHOR_ID = $_SESSION["ID"];

        $S_recipe = "";
        $i = 0;
        foreach(Utils::getOrDie($A_postParams, "recipeInstructions") as $S_instr) {
            $S_recipe.= "\n\n".$S_instr;
            $i++;
        }
        $O_recipe->S_RECIPE = substr($S_recipe, 2);
    }

    public function createAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::login_or_die();

        $O_recipe = RecipeModel::createEmpty();
        self::fillRecipeFromPostParams($O_recipe, $A_postParams);
        $O_recipe->insert();

        $A_ingredientNames = Utils::getOrDie($A_postParams, "recipeIngredientNames");
        $A_ingredientQuantities = Utils::getOrDie($A_postParams, "recipeIngredientQuantities");

        $A_ingredients = array();
        for($i=0; $i<count($A_ingredientNames); $i++) {
            $O_ingr = new IngredientModel(
                $O_recipe->I_ID,
                $A_ingredientNames[$i],
                $A_ingredientQuantities[$i]
            );
            $O_ingr->insert();
            array_push($A_ingredients, $O_ingr);
        }

        header("Location: /recipe/view/".$O_recipe->I_ID);
    }

    public function updateAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        if(count($A_urlParams)!=1){
            throw new HTTPSpecialCaseException(404);
        }
        
        Session::login_or_die();

        $O_recipe = RecipeModel::getByID(Utils::intOrDie($A_urlParams[0]));
        
        if ($O_recipe->I_AUTHOR_ID !== $_SESSION["ID"]) {
            if(!Session::is_admin()){
                throw new HTTPSpecialCaseException(400, "You are not the owner of this recipe");
            }
        }

        self::fillRecipeFromPostParams($O_recipe, $A_postParams);
        $O_recipe->update();

        $A_ingredientNames = Utils::getOrDie($A_postParams, "recipeIngredientNames");
        $A_ingredientQuantities = Utils::getOrDie($A_postParams, "recipeIngredientQuantities");

        $A_ingrsInDB = IngredientModel::searchByRecipe($O_recipe->I_ID);

        for($i=0; $i<count($A_ingredientNames); $i++) {
            $O_ingr = null;

            // search ingredient in DB's list
            foreach($A_ingrsInDB as $O_ingr_loop) {
                if($O_ingr_loop->S_NAME === $A_ingredientNames[$i]) {
                    $O_ingr = $O_ingr_loop;
                    break;
                }
            }

            if($O_ingr === null) {
                // if not present, create if and insert it
                $O_ingr = new IngredientModel(
                    $O_recipe->I_ID,
                    $A_ingredientNames[$i],
                    $A_ingredientQuantities[$i]
                );
                $O_ingr->insert();
            } else {
                $O_ingr->S_QUANTITY = $A_ingredientQuantities[$i];
                $O_ingr->update();
                // if already present, update it and remove it from $A_ingrsInDB

                $ingr_key = array_search($O_ingr, $A_ingrsInDB, true);
                unset($A_ingrsInDB[$ingr_key]);
            }
        }

        header("Location: /recipe/view/".$O_recipe->I_ID);
    }

    public function deleteAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::login_or_die();

        $O_recipe = RecipeModel::getByID(Utils::intOrDie(Utils::getOrDie($A_postParams, "recipe_id")));
        
        if ($O_recipe->I_AUTHOR_ID !== $_SESSION["ID"]) {
            if(!Session::is_admin()){
                throw new HTTPSpecialCaseException(400, "You are not the owner of this recipe");
            }
        }

        $O_recipe->delete();
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

        
        $O_recipe = RecipeModel::getByID($A_urlParams[0]);

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
