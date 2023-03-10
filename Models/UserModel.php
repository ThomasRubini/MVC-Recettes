<?php

final class UserModel extends UserSessionModel
{
    private static $O_ANONUSER = null;

    public $I_ID = null;
    public $S_EMAIL = null;
    public $S_USERNAME= null;
    public $S_PASSWORD_HASH = null;
    public $S_LAST_SEEN = null;
    public $S_FIRST_SEEN = null;
    public $B_ADMIN = 0;
    public $B_DISABLED = 0;

    private function __construct(){}

    public static function createFull($S_EMAIL, $S_USERNAME,$S_PASSWORD_HASH,$S_LAST_SEEN,$S_FIRST_SEEN,$B_ADMIN,$B_DISABLED)
    {   
        $O_user = new UserModel();
        $O_user->S_EMAIL = $S_EMAIL;
        $O_user->S_USERNAME = $S_USERNAME;
        $O_user->S_PASSWORD_HASH = $S_PASSWORD_HASH;
        $O_user->S_LAST_SEEN = $S_LAST_SEEN;
        $O_user->S_FIRST_SEEN = $S_FIRST_SEEN;
        $O_user->B_ADMIN = $B_ADMIN;
        $O_user->B_DISABLED = $B_DISABLED;

        return $O_user;
    }

    public static function createEmpty(){
        $O_user = new UserModel();
    }

    public static function getAnonUser(){
        if(self::$O_ANONUSER === null) {
            self::$O_ANONUSER = new UserModel();
            self::$O_ANONUSER->I_ID = 0;
            self::$O_ANONUSER->S_EMAIL = "anonymous_user@example.fr";
            self::$O_ANONUSER->S_USERNAME = "Anonymous user";
        }
        return self::$O_ANONUSER;
    }
    
    public function insert(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("INSERT INTO USER (EMAIL, USERNAME, PASS_HASH, FIRST_SEEN, LAST_SEEN) VALUES(:email, :username, :password_hash, :first_seen, :last_seen)");
        $stmt->bindParam("email", $this->S_EMAIL);
        $stmt->bindParam("username", $this->S_USERNAME);
        $stmt->bindParam("password_hash", $this->S_PASSWORD_HASH);
        $stmt->bindParam("last_seen", $this->S_LAST_SEEN);
        $stmt->bindParam("first_seen", $this->S_FIRST_SEEN);
        $stmt->execute();
        $this->I_ID = Model::get()->lastInsertId();
    }
    public function update(){
        $O_model = Model::get();
        $stmt = $O_model->prepare("UPDATE USER SET EMAIL=:email, USERNAME=:username, PASS_HASH=:password_hash, FIRST_SEEN=:first_seen, LAST_SEEN=:last_seen, ADMIN=:admin, DISABLED=:disabled WHERE ID=:id");
        $stmt->bindParam("id", $this->I_ID, PDO::PARAM_INT);
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

    private static function createFromRow($A_row, $I_ID){
        $O_user = UserModel::createFull($A_row["EMAIL"],$A_row["USERNAME"],$A_row["PASS_HASH"],$A_row["LAST_SEEN"],$A_row["FIRST_SEEN"],$A_row["ADMIN"],$A_row["DISABLED"]);
        $O_user->I_ID = $I_ID;
        return $O_user;
    }

    public static function getByID($I_id){
        $O_model = Model::get();
        $stmt = $O_model->prepare("SELECT * FROM USER WHERE ID=:id");
        $stmt->bindParam("id", $I_id, PDO::PARAM_INT);
        $stmt->execute();
        
        $row = $stmt->fetch();
        if ($row === false) return null;
        
        return self::createFromRow($row, $I_id);
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

    public function queryProfilePic(){
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
        SELECT *
        FROM USER
        WHERE USER.USERNAME LIKE :full_query
        OR USER.EMAIL LIKE :full_query
        LIMIT 10
        ");
        $S_full_query = "%".$S_query."%";
        $stmt->bindParam("full_query", $S_full_query);
        $stmt->execute();
        
        $A_users = array();
        foreach($stmt->fetchAll() as $row){
            array_push($A_users, self::createFromRow($row, $row["ID"]));
        }

        return $A_users;
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