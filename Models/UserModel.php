<?php

final class UserModel extends UserSessionModel
{
    public $I_ID = null;
    public $S_EMAIL = null;
    public $S_USERNAME= null;
    public $S_PASSWORD_HASH = null;
    public $S_LAST_SEEN = null;
    public $S_FIRST_SEEN = null;
    public $B_ADMIN = 0;
    public $B_DISABLED = 0;

    public function __construct($S_EMAIL, $S_USERNAME,$S_PASSWORD_HASH,$S_LAST_SEEN,$S_FIRST_SEEN,$B_ADMIN,$B_DISABLED)
    {   
        $this->S_EMAIL = $S_EMAIL;
        $this->S_USERNAME = $S_USERNAME;
        $this->S_PASSWORD_HASH = $S_PASSWORD_HASH;
        $this->S_LAST_SEEN = $S_LAST_SEEN;
        $this->S_FIRST_SEEN = $S_FIRST_SEEN;
        $this->B_ADMIN = $B_ADMIN;
        $this->B_DISABLED = $B_DISABLED;
    }
    public function insert(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("INSERT INTO USER (EMAIL, USERNAME, PASS_HASH, FIRST_SEEN) VALUES(:email, :username, :password_hash, :first_seen)");
        $stmt->bindParam("email", $this->S_EMAIL);
        $stmt->bindParam("username", $this->S_USERNAME);
        $stmt->bindParam("password_hash", $this->S_PASSWORD_HASH);
        $stmt->bindParam("first_seen", $this->S_FIRST_SEEN);
        $stmt->execute();
        $this->I_ID = Model::get()->lastInsertId();
    }
    public function update(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("UPDATE USER SET EMAIL=:email, USERNAME=:username, PASSWORD_HASH=:password_hash, FIRST_SEEN:first_seen, LAST_SEEN:last_seen, ADMIN=:admin, DISABLED=:disabled) WHERE ID=:id");
        $stmt->bindParam("id", $this->I_ID);
        $stmt->bindParam("email", $this->S_EMAIL);
        $stmt->bindParam("username", $this->S_USERNAME);
        $stmt->bindParam("password_hash", $this->S_PASSWORD_HASH);
        $stmt->bindParam("first_seen", $this->S_FIRST_SEEN);
        $stmt->bindParam("last_seen", $this->S_LAST_SEEN);
        $stmt->bindParam("admin", $this->B_ADMIN);
        $stmt->bindParam("disabled", $this->B_DISABLED);
        $stmt->execute();
    }

    public function delete(){
        self::anonymise();
        
        $O_model = Model::get();
        $stmt = $O_model->prepare("DELETE FROM USER WHERE ID=:id");
        $stmt->bindParam("id", $this->I_ID);
        $stmt->execute();
    }

    public function anonymise(){
        $O_model = Model::get();

        $stmt = $O_model->prepare("UPDATE RECIPE SET AUTHOR_ID = NULL WHERE AUTHOR_ID = :id");
        $stmt->bindParam("id", $this->I_ID);
        $stmt->execute();

        $stmt = $O_model->prepare("UPDATE APPRECIATION SET AUTHOR_ID = NULL WHERE AUTHOR_ID = :id");
        $stmt->bindParam("id", $this->I_ID);
        $stmt->execute();
    }

    public static function getByID($I_id){
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT * FROM USER WHERE ID=:id");
        $stmt->bindParam("id", $I_id);
        $stmt->execute();
        
        $row = $stmt->fetch();
        if ($row === false) return null;
        
        $O_user = new UserModel($row["EMAIL"],$row["USERNAME"],$row["PASS_HASH"],$row["LAST_SEEN"],$row["FIRST_SEEN"],$row["ADMIN"],$row["DISABLED"]);
        $O_user->I_ID = $I_id;
        return $O_user;
    }

    public static function isEmailInDatabase($S_email){
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT count(*) FROM USER WHERE EMAIL=:email");
        $stmt->bindParam("email", $S_email);
        $stmt->execute();
        $count = $stmt->fetch()[0];
        return $count != 0;
    }

    public static function getByEmail($S_email){
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT ID FROM USER WHERE email=:email");
        $stmt->bindParam("email", $S_email);
        $stmt->execute();
        
        $row = $stmt->fetch();
        if ($row === false) return null;
        return UserModel::getById($row["ID"]);
    }
    public function updateProfilePic($profile_pic_fp){
        $O_model = Model::get();
        $stmt = $O_model->prepare("UPDATE USER SET PROFILE_PIC=:profile_pic WHERE ID=:id");
        $stmt->bindParam("id", $this->I_ID);
        $stmt->bindParam("profile_pic", $profile_pic_fp, PDO::PARAM_LOB);
        $stmt->execute();
    }

    public function getProfilePic(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT PROFILE_PIC FROM USER WHERE ID=:id");
        $stmt->bindParam("id", $this->I_ID);
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row === false) return null;
        return $row["PROFILE_PIC"];
    }

    public function getProfilePicLink(){
        return "/user/profilePic/".$this->I_ID;
    }

    public static function searchUsers($S_query)
    {
        $O_model = Model::get();
        $stmt = $O_model->prepare("
        SELECT ID, EMAIL, USERNAME
        FROM USER
        WHERE USER.USERNAME LIKE :full_query
        OR USER.EMAIL LIKE :full_query
        LIMIT 10
        ");
        $S_full_query = "%".$S_query."%";
        $stmt->bindParam("full_query", $S_full_query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function anonymiseByID($I_id){
        $O_model = Model::get();

        $stmt = $O_model->prepare("UPDATE RECIPE SET AUTHOR_ID = NULL WHERE AUTHOR_ID = :id");
        $stmt->bindParam("id", $I_id);
        $stmt->execute();

        $stmt = $O_model->prepare("UPDATE APPRECIATION SET AUTHOR_ID = NULL WHERE AUTHOR_ID = :id");
        $stmt->bindParam("id", $I_id);
        $stmt->execute();
    }

    public static function deleteByID($I_id)
    {
        $O_model = Model::get();
        UserModel::anonymiseByID($I_id);
        $stmt = $O_model->prepare("DELETE FROM USER WHERE ID=:id");
        $stmt->bindParam("id", $I_id);
        $stmt->execute();
    }
}