<?php

final class RecipeModel
{

    public function getRecipeByID($I_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT * FROM RECIPE WHERE ID=:id");
        $stmt->bindParam("id", $I_id);
        $stmt->execute();

        $row = $stmt->fetch();
        if ($row === false) return null;
        return $row;
    }

    public function getFullRecipe($I_id)
    {
        $A_recipe = self::getRecipeByID($I_id);
        if ($A_recipe === null)return null;

        $A_recipe["IMG_LINK"] = "/static/img/recipes/".$A_recipe["ID"].".jpg";

        $O_ingredientModel = new IngredientModel();
        $A_recipe["INGREDIENTS"] = $O_ingredientModel->searchByRecipe($A_recipe["ID"]);

        
        $A_recipe["AUTHOR_USERNAME"] = UserModel::getByID($A_recipe["AUTHOR_ID"])->S_USERNAME;

        $O_difficultyModel = new DifficultyModel();
        $A_recipe["DIFFICULTY_NAME"] = $O_difficultyModel->getByID($A_recipe["DIFFICULTY_ID"]);

        return $A_recipe;
    }

    public function getFullRecipeWithApprs($I_id)
    {
        $A_recipe = self::getFullRecipe($I_id);
        if ($A_recipe === null)return null;

        $O_apprModel = new ApprModel();
        
        $A_recipe["APPRS"] = $O_apprModel->searchRecipeApprsWithAuthors($I_id);

        return $A_recipe;
    }

    public function searchRecipesByName($S_query)
    {

        $O_model = Model::get();
        $stmt = $O_model->prepare("
        -- split search term at space
        with recursive CTE as (
            select
                CAST(null as char(255)) as NAME,
                CONCAT(:query, ' ') as NAMES

            union all
            select substring_index(NAMES, ' ', 1),
                    substr(NAMES, instr(NAMES, ' ')+1)
            from CTE
            where NAMES != ''
        )

        -- get a row per occurrence and sort by occurrences number
        select RECIPE.ID, RECIPE.NAME,
        CONCAT('/recipe/view/', RECIPE.ID) AS RECIPE_LINK,
        CONCAT('/static/img/recipes/', RECIPE.ID) AS IMG_LINK,
        1 AS NOTE
        from CTE
                JOIN RECIPE
        WHERE CTE.NAME is not null
        AND INSTR(RECIPE.NAME, CTE.NAME) > 0
        GROUP BY RECIPE.ID
        ORDER BY count(RECIPE.ID) DESC
        LIMIT 10;
        ");

        $stmt->bindParam("query", $S_query);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
