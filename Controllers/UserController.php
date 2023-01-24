<?php

$__SESSION_TIMEOUT = 2*60*60;
ini_set("session.gc_maxlifetime", $__SESSION_TIMEOUT);
ini_set("session.cookie_lifetime", $__SESSION_TIMEOUT);

final class UserController
{

    public function loginAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        if (Session::is_login()) {
            header("Location: /user/view");
        } else {
            $S_errmsg = null;
            if(Session::resume_session() && isset($_SESSION["errmsg"])){
                $S_errmsg = $_SESSION["errmsg"];
                unset($_SESSION["errmsg"]);
            }
            View::show("user/login", array("errmsg" => $S_errmsg));
        }
    }

    public function signInAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $S_email = Utils::getOrDie($A_postParams, "email");
        $S_password = Utils::getOrDie($A_postParams, "password");

        $O_userModel = new UserModel();
        $A_user = $O_userModel->getUserByEmail($S_email);
        if ($A_user == null) {
            $S_errmsg = "No user with this email";
        }else if (!password_verify($S_password, $A_user["PASS_HASH"])) {
            $S_errmsg = "Invalid password";
        }else if ($A_user["DISABLED"]) {
            $S_errmsg = "This account is disabled";
        }

        if (isset($S_errmsg)) {
            Session::start_session();
            $_SESSION["errmsg"] = $S_errmsg;
            return header("Location: /user/login");
        }

        Session::set_login($A_user["ID"]);
        
        
        header("Location: /");
    }

    public function signUpAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $S_email = Utils::getOrDie($A_postParams, "email");
        $S_username = Utils::getOrDie($A_postParams, "username");
        $S_password = Utils::getOrDie($A_postParams, "password");

        $O_userModel = new UserModel();

        if (!filter_var($S_email, FILTER_VALIDATE_EMAIL)) {
            $S_errmsg = "invalid email";
        } else if( strlen($S_password) < 8 || strlen($S_password) > 150 ) {
            $S_errmsg = "password must be between 8 and 150 characters";
        } else if($O_userModel->isEmailInDatabase($S_email)) {
            $S_errmsg = "An user with this email is already registered";
        }

        if(isset($S_errmsg)){
            Session::start_session();
            $_SESSION["errmsg"] = $S_errmsg;
            return header("Location: /user/login");
        }

        $S_password_hash = password_hash($S_password, PASSWORD_DEFAULT);

        $O_userModel->createUser($S_email, $S_username, $S_password_hash);
        
        return header("Location: /");
    }


    public function logoutAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::destroy_session();
        header("Location: /");
    }

    // Kept for compatibility purposes
    // TODO do a redirect route once implemented
    public function viewAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        return self::defaultAction($A_urlParams, $A_postParams);
    }

    public function defaultAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        if(count($A_urlParams)!=0){
            throw new HTTPSpecialCaseException(404);
        }

        Session::login_or_die();

        $O_userModel = new UserModel();
        $A_user = $O_userModel->getUserByID($_SESSION["ID"]);

        return View::show("user/edit", $A_user);
    }

    public function updateAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::login_or_die();

        $O_userModel = new UserModel();

        if (isset($_FILES["profilPicture"])) {
            
            if ($_FILES['profilPicture']['error'] !== UPLOAD_ERR_OK) {
                throw new HTTPSpecialCaseException(
                    400,
                    "Upload failed with error code " . $_FILES['profilPicture']['error']
                );
            }

            $info = getimagesize($_FILES['profilPicture']['tmp_name']);
            if ($info === false) {
                throw new HTTPSpecialCaseException(
                    400,
                    "Unable to determine image type of uploaded file"
                );
            }

            if (($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
                throw new HTTPSpecialCaseException(400, "Not a jpeg/png");
            }
            
            $fp = fopen($_FILES['profilPicture']['tmp_name'], 'rb');
            $O_userModel->updateProfilePicByID($_SESSION["ID"], $fp);
        }
        if (isset($_POST["email"])) {
            $S_email = $_POST["email"];
            if (!empty($S_email) && filter_var($S_email, FILTER_VALIDATE_EMAIL)) {
                $O_userModel->updateEmailByID($_SESSION["ID"], $_POST["email"]);
            }else{
                throw new HTTPSpecialCaseException(400, "invalid email");
            }
        }
        if (isset($_POST["username"])) {
            $S_username = $_POST["username"];
            if (!empty($S_username)) {
                $O_userModel->updateUsernameByID($_SESSION["ID"], $_POST["username"]);
            }else{
                throw new HTTPSpecialCaseException(400, "invalid username");
            }
        }

        header("Location: /user");
    }
    
    public function deleteAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        if (count($A_urlParams) ==0 ) {
            self::userDeleteAction($A_urlParams, $A_postParams);
        }else{
            self::adminDeleteAction($A_urlParams, $A_postParams);
        }
    }

    private function userDeleteAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::login_or_die();

        $O_userModel = new UserModel();
        $O_userModel->deleteByID($_SESSION["ID"]);

        Session::destroy_session();

        header("Location: /");
    }

    private function adminDeleteAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::admin_or_die();
        
        $I_user_id = Utils::intOrDie($A_urlParams[0]);


        $O_userModel = new UserModel();
        $O_userModel->deleteByID($I_user_id);

        echo "Le compte à été supprimé avec succès";

    }

    public function profilePicAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        if (count($A_urlParams) !== 1 ) throw new HTTPSpecialCaseException(404);

        $O_userModel = new UserModel();
        $A_user = $O_userModel->getUserByID($A_urlParams[0]);

        if (!isset($A_user)) {
            throw new HTTPSpecialCaseException(404);
        }

        if ($A_user["PROFILE_PIC"] === null) {
            header("Content-Type: image/svg+xml");
            echo file_get_contents(Constants::rootDir()."/static/img/default_user.svg");
        } else {
            header("Content-Type: image");
            echo $A_user["PROFILE_PIC"];
        }


        return Utils::RETURN_RAW;
    }
    
}
