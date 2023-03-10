<?php

$__SESSION_TIMEOUT = 2*60*60;
ini_set("session.gc_maxlifetime", $__SESSION_TIMEOUT);
ini_set("session.cookie_lifetime", $__SESSION_TIMEOUT);

final class UserController
{

    private static function currentDate(){
        return date("Y-m-d H:i:s");
    }

    public function loginAction(Array $A_urlParams = null, Array $A_postParams = null, Array $A_getParams = null)
    {
        if (Session::is_login()) {
            header("Location: /user/view");
        } else {
            $S_errmsg = null;
            if(Session::resume_session() && isset($_SESSION["errmsg"])){
                $S_errmsg = $_SESSION["errmsg"];
                unset($_SESSION["errmsg"]);
            }

            $S_return_uri = "";
            if (isset($A_getParams["return_uri"])) {
                $S_return_uri = $A_getParams["return_uri"];
            }
            View::show("user/login", array("errmsg" => $S_errmsg, "return_uri" => $S_return_uri));
        }
    }

    private function redirectToPreviousPage(Array $A_postParams = null){
        if (isset($A_postParams["return_uri"]) && !empty($A_postParams["return_uri"])) {
            header("Location: ".$A_postParams["return_uri"]);
        } else {
            header("Location: /");
        }
    }
    public function signInAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $S_email = Utils::getOrDie($A_postParams, "email");
        $S_password = Utils::getOrDie($A_postParams, "password");
    
        $O_user = UserModel::getByEmail($S_email);
        if ($O_user == null) {
            $S_errmsg = "No user with this email";
        }else if (!password_verify($S_password,$O_user->S_PASSWORD_HASH)) {
            $S_errmsg = "Invalid password";
        }else if ($O_user->B_DISABLED) {
            $S_errmsg = "This account is disabled";
        }

        if (isset($S_errmsg)) {
            Session::start_session();
            $_SESSION["errmsg"] = $S_errmsg;
            return header("Location: /user/login");
        }

        $O_user->S_LAST_SEEN = self::currentDate();
        $O_user->update();

        Session::set_login($O_user->I_ID);
        
        self::redirectToPreviousPage($A_postParams);
    }

    public function signUpAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $S_email = Utils::getOrDie($A_postParams, "email");
        $S_username = Utils::getOrDie($A_postParams, "username");
        $S_password = Utils::getOrDie($A_postParams, "password");
        $S_password_confirm = Utils::getOrDie($A_postParams, "password_confirm");


        if (!filter_var($S_email, FILTER_VALIDATE_EMAIL)) {
            $S_errmsg = "invalid email";
        } else if( strlen($S_password) < 8 || strlen($S_password) > 150 ) {
            $S_errmsg = "password must be between 8 and 150 characters";
        } else if( $S_password !== $S_password_confirm) {
            $S_errmsg = "password confirmation do not match";
        } else if(UserModel::isEmailInDatabase($S_email)) {
            $S_errmsg = "An user with this email is already registered";
        }

        if(isset($S_errmsg)){
            Session::start_session();
            $_SESSION["errmsg"] = $S_errmsg;
            return header("Location: /user/login");
        }

        $S_password_hash = password_hash($S_password, PASSWORD_DEFAULT);
        
        $O_user = UserModel::createFull($S_email, $S_username, $S_password_hash, self::currentDate(), self::currentDate(), 0, 0);
        $O_user->insert();

        Session::set_login($O_user->I_ID);

        self::redirectToPreviousPage($A_postParams);
    }


    public function logoutAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::destroy_session();
        header("Location: /");
    }

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

        $O_user = UserModel::getByID($_SESSION["ID"]);
        
        return View::show("user/edit", array("USER" => $O_user));
    }

    public function updateAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::login_or_die();

        $O_user = UserModel::getByID($_SESSION["ID"]);

        $fp = Utils::tryProcessImg("profilPicture");
        if($fp !== null) {
            $O_user->updateProfilePic($fp);
        }

        if (isset($_POST["email"]) && !empty($S_email)) {
            $S_email = $_POST["email"];
            if (filter_var($S_email, FILTER_VALIDATE_EMAIL)) {
                $O_user->S_EMAIL = $_POST["email"];
                $O_user->update();
            } else {
                throw new HTTPSpecialCaseException(400, "Invalid email");
            }
        }
        if (isset($_POST["username"]) && !empty($S_email)) {
            $O_user->S_USERNAME = $_POST["username"];
            $O_user->update();
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

        UserModel::deleteByID($_SESSION["ID"]);

        Session::destroy_session();

        header("Location: /");
    }

    private function adminDeleteAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::admin_or_die();
        
        $I_user_id = Utils::intOrDie($A_urlParams[0]);

        UserModel::deleteByID($I_user_id);

        echo "Le compte ?? ??t?? supprim?? avec succ??s";

    }

    public function profilePicAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        if (count($A_urlParams) !== 1 ) throw new HTTPSpecialCaseException(404);

        $O_user = UserModel::getByID($A_urlParams[0]);
        
        if (isset($O_user)) {
            $S_pfp = $O_user->queryProfilePic();
            if($S_pfp !== null) {
                header("Content-Type: image");
                echo $S_pfp;
                return Utils::RETURN_RAW;
            }
        }            
            
        header("Content-Type: image/svg+xml");
        echo file_get_contents(Constants::rootDir()."/static/img/default_user.svg");
        return Utils::RETURN_RAW;
    }
}
