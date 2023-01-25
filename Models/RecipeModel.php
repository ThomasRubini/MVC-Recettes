<?php

final class RecipeModel
{
    public $I_ID = null;
    public $S_NAME = null;
    public $I_TIME = null;
    public $I_COST = null;
    public $S_DESCR = null;
    public $S_RECIPE = null;
    public $I_DIFFICULTY_ID = null;
    public $I_AUTHOR_ID = null;
    
    public $O_DIFFICULTY = null;
    public $O_AUTHOR = null;
    public $A_APPRS = null;
    public $A_INGREDIENTS = null;
    
    public function __construct($S_NAME, $I_TIME, $I_COST, $S_DESCR, $S_RECIPE, $I_DIFFICULTY_ID, $I_AUTHOR_ID)
    {
        $this->S_NAME = $S_NAME;
        $this->I_TIME = $I_TIME;
        $this->I_COST = $I_COST;
        $this->S_DESCR = $S_DESCR;
        $this->S_RECIPE = $S_RECIPE;
        $this->I_DIFFICULTY_ID = $I_DIFFICULTY_ID;
        $this->I_AUTHOR_ID = $I_AUTHOR_ID;        
    }

    public function insert()
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("INSERT INTO RECIPE (NAME, TIME, COST, DESCR, RECIPE ,DIFFICULTY_ID, AUTHOR_ID) VALUES(:name, :time, :cost, :desc, :recipe, :difficulty_id, :author_id)");
        $stmt->bindParam("name", $this->S_NAME);
        $stmt->bindParam("time", $this->I_TIME);
        $stmt->bindParam("cost", $this->I_COST);
        $stmt->bindParam("desc", $this->S_DESCR);
        $stmt->bindParam("recipe", $this->S_RECIPE);
        $stmt->bindParam("difficulty_id", $this->I_DIFFICULTY_ID);
        $stmt->bindParam("author_id", $this->I_AUTHOR_ID);
        $stmt->execute();
        $this->I_ID = Model::get()->lastInsertId();
    }
    public function update()
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("UPDATE RECIPE SET NAME=:name, TIME=:time, COST=:cost, DESCR=:desc, RECIPE:recipe, DIFFICULTY_ID=:difficulty_id, AUTHOR_ID=:author_id WHERE ID=:id");
        $stmt->bindParam("id", $this->I_ID);
        $stmt->bindParam("name", $this->S_NAME);
        $stmt->bindParam("time", $this->I_TIME);
        $stmt->bindParam("cost", $this->I_COST);
        $stmt->bindParam("desc", $this->S_DESCR);
        $stmt->bindParam("recipe", $this->S_RECIPE);
        $stmt->bindParam("difficulty_id", $this->I_DIFFICULTY_ID);
        $stmt->bindParam("author_id", $this->I_AUTHOR_ID);
        $stmt->execute();
    }
    public function delete(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("DELETE FROM RECIPE WHERE ID=:id");
        $stmt->bindParam("id", $this->I_ID);
        $stmt->execute();
    }

    public static function getRecipeByID($I_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT * FROM RECIPE WHERE ID=:id");
        $stmt->bindParam("id", $I_id);
        $stmt->execute();

        $row = $stmt->fetch();
        if ($row === false) return null;

        $O_recipe = new RecipeModel($row["NAME"], $row["TIME"], $row["COST"], $row["DESCR"], $row["RECIPE"], $row["DIFFICULTY_ID"], $row["AUTHOR_ID"]);

        $O_recipe->I_ID = $I_id;
        return $O_recipe;
    }

    public function getImage(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT IMG FROM RECIPE WHERE ID=:id");
        $stmt->bindParam("id", $this->I_ID);
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row === false) return null;
        return $row["IMG"];
    }

    public function getAuthor(){
        if($this->O_AUTHOR === null){
            $this->O_AUTHOR = UserModel::getByID($this->I_AUTHOR_ID);
        }
        return $this->O_AUTHOR;
    }

    public function getIngredients(){
        if($this->A_INGREDIENTS === null){
            $this->A_INGREDIENTS = IngredientModel::searchByRecipe($this->I_ID);
        }
        return $this->A_INGREDIENTS;
    }
    public function getDifficulty(){
        if($this->O_AUTHOR === null){
            $this->O_AUTHOR = DifficultyModel::getByID($this->I_DIFFICULTY_ID);
        }
        return $this->O_AUTHOR;
    }

    public function getApprs(){
        if ($this->A_APPRS === null) {
            $O_apprModel = new ApprModel();
            $this->A_APPRS = $O_apprModel->searchRecipeApprsWithAuthors($this->I_ID);
        }
        return $this->A_APPRS;
    }

    public function getFullRecipe()
    {
        $this->getAuthor();
        $this->getDifficulty();
        $this->getIngredients();
    }
    public static function getFullRecipeById($I_id)
    {
        $O_recipe = self::getRecipeByID($I_id);
        $O_recipe->getFullRecipe();
        return $O_recipe;
    }

    public static function getFullRecipeWithApprs($I_id)
    {
        $O_recipe = self::getFullRecipeById($I_id);
        if ($O_recipe === null)return null;

        $O_recipe->getApprs();

        return $O_recipe;
    }

    //TODO: return array object
    public static function searchRecipesByName($S_query)
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
        ORDER BY count(RECIPE.ID) DESCR
        LIMIT 10;
        ");

        $stmt->bindParam("query", $S_query);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
