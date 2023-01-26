<?php

final class ApprModel {
    public $I_ID = null;
    public $S_COMMENT = null;
    public $I_NOTE = null;
    public $S_DATE = null;
    public $I_AUTHOR_ID = null;
    public $I_RECIPE_ID = null;

    public $O_AUTHOR = null;

    public function __construct($S_COMMENT, $I_NOTE, $S_DATE, $I_AUTHOR_ID, $I_RECIPE_ID)
    {
        $this->S_COMMENT = $S_COMMENT;
        $this->I_NOTE = $I_NOTE;
        $this->S_DATE = $S_DATE;
        $this->I_AUTHOR_ID = $I_AUTHOR_ID;
        $this->I_RECIPE_ID = $I_RECIPE_ID;
    }
    private static function createFromRow($A_row,$I_id){
        $O_appr = new ApprModel($A_row["COMMENT"], $A_row["NOTE"], $A_row["DATE"], $A_row["AUTHOR_ID"], $A_row["RECIPE_ID"]);
        $O_appr->I_ID = $I_id;
        return $O_appr;
    }

    public function insert(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("INSERT INTO APPRECIATION (COMMENT, NOTE, DATE, AUTHOR_ID, RECIPE_ID) VALUES(:comment, :note, :date, :author_id, :recipe_id)");
        $stmt->bindParam("comment", $this->S_COMMENT);
        $stmt->bindParam("note", $this->I_NOTE);
        $stmt->bindParam("date", $this->S_DATE);
        $stmt->bindParam("author_id", $this->I_AUTHOR_ID);
        $stmt->bindParam("recipe_id", $this->I_RECIPE_ID);
        $stmt->execute();
        $this->I_ID = Model::get()->lastInsertId();
    }
    public function update(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("UPDATE APPRECIATION SET COMMENT=:comment, NOTE =:note, DATE =:date, AUTHOR_ID =:author_id, RECIPE_ID =:recipe_id WHERE ID = :id");
        $stmt->bindParam("id", $this->I_ID);
        $stmt->bindParam("comment", $this->S_COMMENT);
        $stmt->bindParam("note", $this->I_NOTE);
        $stmt->bindParam("date", $this->S_DATE);
        $stmt->bindParam("author_id", $this->I_AUTHOR_ID);
        $stmt->bindParam("recipe_id", $this->I_RECIPE_ID);
        $stmt->execute();
        $this->I_ID = Model::get()->lastInsertId();
    }
    public function delete(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("DELETE FROM APPRECIATION WHERE ID=:id");
        $stmt->bindParam("id", $this->I_ID);
        $stmt->execute();
    }

    public function getAuthor(){
        if($this->O_AUTHOR === null){
            $this->O_AUTHOR = UserModel::getByID($this->I_AUTHOR_ID);
        }
        return $this->O_AUTHOR;
    }

    //DECRECATED 
    public static function searchRecipeApprsWithAuthors($I_recipe_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("
            SELECT APPRECIATION.*, USER.USERNAME as AUTHOR_NAME,
            CONCAT('/user/profilePic/', APPRECIATION.AUTHOR_ID) AS AUTHOR_IMG_LINK
            FROM APPRECIATION
            JOIN USER ON USER.ID = APPRECIATION.AUTHOR_ID
            WHERE RECIPE_ID = :recipe_id
        ");
        $stmt->bindParam("recipe_id", $I_recipe_id);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function searchRecipeApprs($I_recipe_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT * FROM APPRECIATION WHERE RECIPE_ID = :recipe_id");
        $stmt->bindParam("recipe_id", $I_recipe_id);
        $stmt->execute();
        $A_apprs = array();
        foreach($stmt->fetchAll() as $row){
            array_push($A_apprs, self::createFromRow($row, $row["ID"]));
        }
        return $A_apprs;
    }

    public static function deleteById($I_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("DELETE FROM APPRECIATION WHERE ID = :appr_id");
        $stmt->bindParam("appr_id", $I_id);
        $stmt->execute();
    }

    public static function getApprById($I_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT * FROM APPRECIATION WHERE ID = :appr_id");
        $stmt->bindParam("appr_id", $I_id);
        $stmt->execute();

        $row = $stmt->fetch();
        if ($row === false) return null;
        $O_appr = new ApprModel($row["COMMENT"], $row["NOTE"], $row["DATE"], $row["AUTHOR_ID"], $row["RECIPE_ID"]);
        $O_appr->I_ID = $I_id;
        return $O_appr;
    }

    public static function getAppsrByRecipeId($I_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT * FROM APPRECIATION WHERE RECIPE_ID = :recipe_id");
        $stmt->bindParam("recipe_id", $I_id);
        $stmt->execute();

        $row = $stmt->fetch();
        if ($row === false) return null;
        $O_appr = new ApprModel($row["COMMENT"], $row["NOTE"], $row["DATE"], $row["AUTHOR_ID"], $row["RECIPE_ID"]);
        $O_appr->I_ID = $I_id;
        return $O_appr;
    }
}
