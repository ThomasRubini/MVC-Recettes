<?php

final class UserModel
{

    public function createUser($S_email, $S_username, $S_password_hash){
        $O_model = Model::get();
        $stmt = $O_model->prepare("INSERT INTO USER (EMAIL, NAME, PASS_HASH) VALUES(:email, :name, :password_hash)");
        $stmt->bindParam("email", $S_email);
        $stmt->bindParam("name", $S_name);
        $stmt->bindParam("password_hash", $S_password_hash);
        $stmt->execute();
    }

    public function isEmailInDatabase($S_email){

        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT count(*) FROM USER WHERE EMAIL=:email");
        $stmt->bindParam("email", $S_email);
        $stmt->execute();

        $count = $stmt->fetch()[0];
        return $count != 0;
    }


    public function isPasswordValid($S_email, $S_password){
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT PASS_HASH FROM USER WHERE EMAIL=:email");
        $stmt->bindParam("email", $S_email);
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
