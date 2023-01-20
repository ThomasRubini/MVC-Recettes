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

    public function editAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        // demo array, remove this when we use the real edit function
        $A_returnArray = array(
            "recipeName" => "Pâte à crêpe",
            "recipeDescription" => "Légère et délicate, la pâte à crêpe est idéale pour des crêpes fines et croustillantes. Avec sa texture est onctueuse et son goût subtil, c'est un plat traditionnel français populaire chez tout le monde.",
            "recipeDifficutly" => "Facile",
            "recipeType" => array(),
            "recipeTime" => "45",
            "recipeIngredients" => array(
                "Farine" => "300g",
                "Sucre" => "3 cuillère à soupe",
                "Beurre fondu" => "50g",
                "Rhum" => "5cl",
                "Œuf" => "3",
                "Huile" => "2 cuillères à soupe",
                "Lait" => "60cl"
            ),
            "recipeInstructions" => "Mettre la farine dans une terrine et former un puits.\nY déposer les oeufs entiers, le sucre, l'huile et le beurre.\nMélanger délicatement avec un fouet en ajoutant au fur et à mesure le lait. La pâte ainsi obtenue doit avoir une consistance d'un liquide légèrement épais.\nParfumer de rhum.\nFaire chauffer une poêle antiadhésive et la huiler très légèrement à l'aide d'un papier Essuie-tout. Y verser une louche de pâte, la répartir dans la poêle puis attendre qu'elle soit cuite d'un côté avant de la retourner. Cuire ainsi toutes les crêpes à feu doux."
        );

        // need to send an array with names even if content is empty
        View::show("recipe/edit", $A_returnArray);

        // print_r($A_urlParams);
        // $O_recetteModel = new RecipeIngredientsModel();
        // $O_recetteModel->getByID("");
        // View::show('helloworld/testform', array('formData' =>  $A_postParams));

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
        View::show("recipe/search", array("SEARCH_TERM" => null));
    }
    
    private function searchQueryView(Array $A_urlParams = null, Array $A_postParams = null, Array $A_getParams = null)
    {
        $A_results = array();
        View::show("recipe/search", array(
            "SEARCH_TERM" => $A_getParams["query"],
            "RESULTS" => $A_results,
        ));
    }

}
