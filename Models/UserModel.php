<?php

final class UserModel
{

    public function createUser($S_email, $S_username, $S_password_hash){
        $O_model = Model::get();
        $stmt = $O_model->prepare("INSERT INTO USER (EMAIL, USERNAME, PASS_HASH) VALUES(:email, :username, :password_hash)");
        $stmt->bindParam("email", $S_email);
        $stmt->bindParam("username", $S_username);
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


    public function getUserByID($I_id){
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT * FROM USER WHERE ID=:id");
        $stmt->bindParam("id", $I_id);
        $stmt->execute();
        
        $row = $stmt->fetch();
        if ($row === false) return null;
        return $row;
    }

    public function getUserByEmail($S_email){
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT * FROM USER WHERE email=:email");
        $stmt->bindParam("email", $S_email);
        $stmt->execute();
        
        $row = $stmt->fetch();
        if ($row === false) return null;
        return $row;
    }

    public function getUsernameByID($I_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT USERNAME FROM USER WHERE ID=:id");
        $stmt->bindParam("id", $I_id);
        $stmt->execute();
        
        $row = $stmt->fetch();
        if ($row === false) return null;
        return $row["USERNAME"];
    }

    public function isUserActive($I_id)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT DISABLED FROM USER WHERE ID=:id");
        $stmt->bindParam("id", $I_id);
        $stmt->execute();
        
        $row = $stmt->fetch();
        if ($row === false) return false;
        return $row["DISABLED"] !== 1;
    }
}
