<?php

final class IngredientModel
{
    public $I_INGREDIENT_ID;
    public $I_RECIPE_ID;
    public $S_NAME;
    public $S_QUANTITY;

    public function __construct($I_RECIPE_ID, $S_NAME, $S_QUANTITY)
    {
        $this->I_RECIPE_ID = $I_RECIPE_ID;
        $this->S_NAME = $S_NAME;
        $this->S_QUANTITY = $S_QUANTITY;
    }
    
    private static function createFromRow($A_row, $I_ingredient_id)
    {
        $O_ingr = new IngredientModel($A_row["RECIPE_ID"], $A_row["NAME"], $A_row["QUANTITY"]);
        $O_ingr->I_INGREDIENT_ID = $I_ingredient_id;
        return $O_ingr; 
    }
    
    public function insert(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT ID FROM INGREDIENT WHERE :name=name");
        $stmt->bindParam("name", $this->S_NAME);
        $stmt->execute();
        if($stmt->rowCount() === 0){
            $stmt = $O_model->prepare("INSERT INTO INGREDIENT (NAME) VALUES(:name)");
            $stmt->bindParam("name", $this->S_NAME);
            $stmt->execute();
            $this->I_INGREDIENT_ID = Model::get()->lastInsertId();
        } else {
            $this->I_INGREDIENT_ID = $stmt->fetch()["ID"];
        }
        $stmt = $O_model->prepare("INSERT INTO RECIPE_INGREDIENT VALUES(:recipe_id, :ingredient_id, :quantity)");
        $stmt->bindParam("recipe_id", $this->I_RECIPE_ID);
        $stmt->bindParam("ingredient_id", $this->I_INGREDIENT_ID);
        $stmt->bindParam("quantity", $this->S_QUANTITY);
        $stmt->execute();
    }
    
    public function update(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("UPDATE RECIPE_INGREDIENT SET QUANTITY=:quantity
        WHERE RECIPE_ID=:recipe_id AND INGREDIENT_ID=:ingredient_id");
        $stmt->bindParam("quantity", $this->S_QUANTITY);
        $stmt->bindParam("recipe_id", $this->I_RECIPE_ID);
        $stmt->bindParam("ingredient_id", $this->I_INGREDIENT_ID);
        $stmt->execute();
    }

    public function delete(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("DELETE FROM INGREDIENT WHERE ID=:id");
        $stmt->bindParam("id", $this->I_INGREDIENT_ID);
        $stmt->execute();
        $stmt = $O_model->prepare("DELETE FROM RECIPE_INGREDIENT WHERE INGREDIENT_ID=:id");
        $stmt->execute();
        $stmt->bindParam("id", $this->I_INGREDIENT_ID);
        $stmt->execute();
    }

    public static function getByRecipeAndName($I_recipe_id, $S_name){
        $S_name = strtolower($S_name);
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT *, INGREDIENT.ID AS INGREDIENT_ID FROM INGREDIENT
            JOIN RECIPE_INGREDIENT RI on INGREDIENT.ID = RI.INGREDIENT_ID
            RECIPE.ID=:recipe_id AND WHERE NAME=:name");
        $stmt->bindParam("recipe_id", $I_recipe_id);
        $stmt->bindParam("name", $S_name);
        $stmt->execute();

        $row = $stmt->fetch();
        if ($row === false) return null;

        return self::createFromRow($row, $row["INGREDIENT_ID"]);
    }

    public static function searchByRecipe($I_recipe_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("
        SELECT *, INGREDIENT.ID AS INGREDIENT_ID FROM INGREDIENT
        JOIN RECIPE_INGREDIENT ON RECIPE_INGREDIENT.INGREDIENT_ID=INGREDIENT.ID
        WHERE RECIPE_INGREDIENT.RECIPE_ID = :recipe_id
        ");
        $stmt->bindParam("recipe_id", $I_recipe_id);
        $stmt->execute();
        
        $A_ingr = array();
        foreach($stmt->fetchAll() as $row){
            array_push($A_ingr, self::createFromRow($row, $row["INGREDIENT_ID"]));
        }

        return $A_ingr;
    }
}
