<?php

final class ParticularityModel
{
    public $I_PARTICULARITY_ID;
    public $I_RECIPE_ID;
    public $S_NAME;

    public function __construct($I_RECIPE_ID, $S_NAME)
    {
        $this->I_RECIPE_ID = $I_RECIPE_ID;
        $this->S_NAME = $S_NAME;
    }
    
    private static function createFromRow($A_row, $I_PARTICULARITY_id)
    {
        $O_ingr = new ParticularityModel($A_row["RECIPE_ID"], $A_row["NAME"]);
        $O_ingr->I_PARTICULARITY_ID = $I_PARTICULARITY_id;
        return $O_ingr; 
    }
    
    public function insert(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT 1 FROM PARTICULARITY WHERE :name=name");
        $stmt->bindParam("name", $this->S_NAME);
        $stmt->execute();
        if($stmt->rowCount() === 0){
            $stmt = $O_model->prepare("INSERT INTO PARTICULARITY (NAME) VALUES(:name)");
            $stmt->bindParam("name", $this->S_NAME);
            $stmt->execute();
            $this->I_PARTICULARITY_ID = Model::get()->lastInsertId();
        }
        $stmt = $O_model->prepare("INSERT INTO RECIPE_PARTICULARITY VALUES(:recipe_id, :particularity_id)");
        $stmt->bindParam("recipe_id", $this->I_RECIPE_ID);
        $stmt->bindParam("particularity_id", $this->I_PARTICULARITY_ID);
        $stmt->execute();
    }
    

    public function delete(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("DELETE FROM PARTICULARITY WHERE ID=:id");
        $stmt->bindParam("id", $this->I_PARTICULARITY_ID);
        $stmt->execute();
        $stmt = $O_model->prepare("DELETE FROM RECIPE_PARTICULARITY WHERE PARTICULARITY_ID=:id");
        $stmt->execute();
        $stmt->bindParam("id", $this->I_PARTICULARITY_ID);
        $stmt->execute();
    }

    public static function searchByRecipe($I_recipe_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("
        SELECT *, PARTICULARITY.ID AS PARTICULARITY_ID FROM PARTICULARITY
        JOIN RECIPE_PARTICULARITY ON RECIPE_PARTICULARITY.PARTICULARITY_ID=PARTICULARITY.ID
        WHERE RECIPE_PARTICULARITY.RECIPE_ID = :recipe_id
        ");
        $stmt->bindParam("recipe_id", $I_recipe_id);
        $stmt->execute();
        
        $A_ingr = array();
        foreach($stmt->fetchAll() as $row){
            array_push($A_ingr, self::createFromRow($row, $row["PARTICULARITY_ID"]));
        }

        return $A_ingr;
    }


}
