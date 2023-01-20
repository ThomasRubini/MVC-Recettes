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

    public function getFullRecipeWithApprs($I_id)
    {
        $A_recipe = self::getRecipeByID($I_id);
        if ($A_recipe === null)return null;

        $A_recipe["IMAGE_URL"] = "/static/img/recipes/".$A_recipe["ID"].".jpg";

        $O_ingredientModel = new IngredientModel();
        $A_recipe["INGREDIENTS"] = $O_ingredientModel->searchByRecipe($A_recipe["ID"]);

        $O_userModel = new UserModel();
        $A_recipe["AUTHOR_USERNAME"] = $O_userModel->getUsernameByID($A_recipe["AUTHOR_ID"]);

        $O_userModel = new DifficultyModel();
        $A_recipe["DIFFICULTY_NAME"] = $O_userModel->getByID($A_recipe["DIFFICULTY_ID"]);

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
        select RECIPE.ID, RECIPE.NAME
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
