<?php

final class RecipeModel
{
    public $I_ID = null;
    public $S_NAME = null;
    public $I_TIME = null;
    public $S_DESCR = null;
    public $S_RECIPE = null;
    public $I_DIFFICULTY_ID = null;
    public $I_AUTHOR_ID = null;
    
    public $O_DIFFICULTY = null;
    public $O_AUTHOR = null;
    public $A_APPRS = null;
    public $A_INGREDIENTS = null;
    
    private function __construct(){}

    public static function createEmpty()
    {
        return new RecipeModel();
    }

    public static function createFull($S_NAME, $I_TIME, $S_DESCR, $S_RECIPE, $I_DIFFICULTY_ID, $I_AUTHOR_ID)
    {
        $O_recipe = new RecipeModel();
        $O_recipe->S_NAME = $S_NAME;
        $O_recipe->I_TIME = $I_TIME;
        $O_recipe->S_DESCR = $S_DESCR;
        $O_recipe->S_RECIPE = $S_RECIPE;
        $O_recipe->I_DIFFICULTY_ID = $I_DIFFICULTY_ID;
        $O_recipe->I_AUTHOR_ID = $I_AUTHOR_ID;
        return $O_recipe;
    }

    public function insert()
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("INSERT INTO RECIPE (NAME, TIME, DESCR, RECIPE ,DIFFICULTY_ID, AUTHOR_ID) VALUES(:name, :time, :descr, :recipe, :difficulty_id, :author_id)");
        $stmt->bindParam("name", $this->S_NAME);
        $stmt->bindParam("time", $this->I_TIME);
        $stmt->bindParam("descr", $this->S_DESCR);
        $stmt->bindParam("recipe", $this->S_RECIPE);
        $stmt->bindParam("difficulty_id", $this->I_DIFFICULTY_ID);
        $stmt->bindParam("author_id", $this->I_AUTHOR_ID);
        $stmt->execute();
        $this->I_ID = Model::get()->lastInsertId();
    }
    public function update()
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("UPDATE RECIPE SET NAME=:name, TIME=:time, DESCR=:descr, RECIPE=:recipe, DIFFICULTY_ID=:difficulty_id, AUTHOR_ID=:author_id WHERE ID=:id");
        $stmt->bindParam("id", $this->I_ID);
        $stmt->bindParam("name", $this->S_NAME);
        $stmt->bindParam("time", $this->I_TIME);
        $stmt->bindParam("descr", $this->S_DESCR);
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

    private static function createFromRow($A_row, $I_ID){
        $O_recipe = RecipeModel::createFull($A_row["NAME"], $A_row["TIME"], $A_row["DESCR"], $A_row["RECIPE"], $A_row["DIFFICULTY_ID"], $A_row["AUTHOR_ID"]);
        $O_recipe->I_ID = $I_ID;
        return $O_recipe;
    }

    public static function getByID($I_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT * FROM RECIPE WHERE ID=:id");
        $stmt->bindParam("id", $I_id);
        $stmt->execute();

        $row = $stmt->fetch();
        if ($row === false) return null;

        return self::createFromRow($row, $I_id);
    }

    public function getImgLink(){
        return '/recipe/img/'.$this->I_ID;
    }

    public function getLink(){
        return '/recipe/view/'.$this->I_ID;
    }

    public function queryImg(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT IMG FROM RECIPE WHERE ID=:id");
        $stmt->bindParam("id", $this->I_ID);
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row === false) return null;
        return $row["IMG"];
    }

    public function queryNote(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("
            SELECT avg(NOTE) AS AVG FROM APPRECIATION
            WHERE RECIPE_ID = :id
        ");
        $stmt->bindParam("id", $this->I_ID);
        $stmt->execute();

        $row = $stmt->fetch();
        if ($row === false) return null;
        $avg = $row["AVG"];
        
        return round($avg*2)/2;
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
        if($this->O_DIFFICULTY === null){
            $this->O_DIFFICULTY = DifficultyModel::getByID($this->I_DIFFICULTY_ID);
        }
        return $this->O_DIFFICULTY;
    }

    public function getApprs(){
        if ($this->A_APPRS === null) {
            $this->A_APPRS = ApprModel::searchRecipeApprs($this->I_ID);
        }
        return $this->A_APPRS;
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
        select RECIPE.*
        from CTE
                JOIN RECIPE
        WHERE CTE.NAME is not null
        AND INSTR(RECIPE.NAME, CTE.NAME) > 0
        GROUP BY RECIPE.ID
        ORDER BY count(RECIPE.ID)
        LIMIT 10;
        ");

        $stmt->bindParam("query", $S_query);
        $stmt->execute();
        
        $A_recipes = array();
        foreach($stmt->fetchAll() as $row){
            array_push($A_recipes, self::createFromRow($row, $row["ID"]));
        }

        return $A_recipes;
    }

    public static function getRandomRecipes($I_n)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("
        SELECT * FROM RECIPE
        ORDER BY RAND()
        LIMIT :n
        ");
        $stmt->bindParam("n", $I_n, PDO::PARAM_INT);
        $stmt->execute();
  
        $A_recipes = array();
        foreach($stmt->fetchAll() as $row){
            array_push($A_recipes, self::createFromRow($row, $row["ID"]));
        }

        return $A_recipes;
    }
}
