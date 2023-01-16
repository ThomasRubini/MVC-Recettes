<?php

final class UserModel
{

    public function createUser($S_name, $S_password_hash){
        $O_model = Model::get();
        $stmt = $O_model->prepare("INSERT INTO USER (NAME, PASS_HASH) VALUES(:name, :password_hash)");
        $stmt->bindParam("name", $S_name);
        $stmt->bindParam("password_hash", $S_password_hash);
        $stmt->execute();
    }

    public function isUserInDatabase($S_name){

        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT count(*) FROM USER WHERE NAME=:name");
        $stmt->bindParam("name", $S_name);
        $stmt->execute();

        return $stmt->fetch()[0] !== 0;
    }


    public function isPasswordValid($S_name, $S_password){
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT PASS_HASH FROM USER WHERE NAME=:name");
        $stmt->bindParam("name", $S_name);
        $stmt->execute();
        
        if($stmt->rowCount()==1){
            $row = $stmt->fetch();
            return password_verify($S_password, $row["PASS_HASH"]);
        }
        return False;
    }

    public function getNameByID($I_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT NAME FROM USER WHERE ID=:id");
        $stmt->bindParam("id", $I_id);
        $stmt->execute();
        
        $row = $stmt->fetch();
        if ($row === false) return null;
        return $row["NAME"];
    }
}
