<?php

final class DifficultyModel
{
    public $I_ID;
    public $S_NAME;


    public function __construct($S_NAME){
        $this->S_NAME = $S_NAME;
    }
    public function insert(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("INSERT INTO DIFFICULTY (NAME) VALUES(:name)");
        $stmt->bindParam("name", $this->S_NAME);
        $stmt->execute();
        $this->I_ID = Model::get()->lastInsertId();
    }
    public function update()
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("UPDATE DIFFICULTY SET NAME=:name WHERE ID=:id");
        $stmt->bindParam("id", $this->I_ID);
        $stmt->bindParam("name", $this->S_NAME);

    }
    public function delete(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("DELETE FROM DIFFICULTY WHERE ID=:id");
        $stmt->bindParam("id", $this->I_ID);
        $stmt->execute();
    }

    public static function getByID($I_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT * FROM DIFFICULTY WHERE ID=:id");
        $stmt->bindParam("id", $I_id);
        $stmt->execute();
        
        $row = $stmt->fetch();
        if ($row === false) return null;

        $O_diff = new DifficultyModel($row["NAME"]);
        $O_diff->I_ID = $I_id;
        return $O_diff;
    }
    public static function getByName($S_name){
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT ID FROM DIFFICULTY WHERE NAME=:name");
        $stmt->bindParam("name", $S_name);
        $stmt->execute();
        
        $row = $stmt->fetch();
        if ($row === false) return null;
        return DifficultyModel::getByID($row['ID']);
    }
    public static function deleteByID($I_id)
    {
        $O_model = Model::get();
        UserModel::anonymiseByID($I_id);
        $stmt = $O_model->prepare("DELETE FROM DIFFICULTY WHERE ID=:id");
        $stmt->bindParam("id", $I_id);
        $stmt->execute();
    }
}
