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

    private function getOrDie($DICT, $key)
    {
        if (isset($DICT[$key])) return $DICT[$key];
        else die("Key $key not present");
    }

    public function signInAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $S_email = self::getOrDie($A_postParams, "email");
        $S_password = self::getOrDie($A_postParams, "password");

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
        $S_email = self::getOrDie($A_postParams, "email");
        $S_username = self::getOrDie($A_postParams, "username");
        $S_password = self::getOrDie($A_postParams, "password");

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
            return View::show("errors/404");
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

        if (isset($_POST["email"])) {
            $S_email = $_POST["email"];
            if (!empty($S_email) && filter_var($S_email, FILTER_VALIDATE_EMAIL)) {
                $O_userModel->updateEmailByID($_SESSION["ID"], $_POST["email"]);
            }
        }
        if (isset($_POST["username"])) {
            $S_username = $_POST["username"];
            if (!empty($S_username)) {
                $O_userModel->updateUsernameByID($_SESSION["ID"], $_POST["username"]);
            }
        }

        header("Location: /user");
    }
}
