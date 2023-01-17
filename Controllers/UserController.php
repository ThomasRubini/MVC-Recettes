<?php

$__SESSION_TIMEOUT = 2*60*60;
ini_set("session.gc_maxlifetime", $__SESSION_TIMEOUT);
ini_set("session.cookie_lifetime", $__SESSION_TIMEOUT);

final class UserController
{

    public function loginAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        View::show("user/login");
    }

    private function get_or_die($DICT, $key)
    {
        if (isset($DICT[$key])) return $DICT[$key];
        else die("Key $key not present");
    }

    public function signInAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $S_email = self::get_or_die($A_postParams, "email");
        $S_password = self::get_or_die($A_postParams, "password");

        $O_userModel = new UserModel();
        $A_user = $O_userModel->getUserByEmail($S_email);
        if ($A_user == null) {
            return View::show("user/signin", array("success" => False, "msg" => "No user with this email"));
        }
        if (!password_verify($S_password, $A_user["PASS_HASH"])) {
            return View::show("user/signin", array("success" => False, "msg" => "Invalid password"));
        }
        if ($A_user["DISABLED"]) {
            return View::show("user/signin", array("success" => False, "msg" => "This account is disabled"));
        }

        Session::start($A_user["ID"]);
        
        View::show("user/signin", array("success" => True));
    }

    public function signUpAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $S_email = self::get_or_die($A_postParams, "email");
        $S_username = self::get_or_die($A_postParams, "username");
        $S_password = self::get_or_die($A_postParams, "password");

        if (!filter_var($S_email, FILTER_VALIDATE_EMAIL)) {
            $S_errmsg = "invalid email";
        } else if( strlen($S_password) < 8 || strlen($S_password) > 150 ) {
            $S_errmsg = "password must be between 8 and 150 characters";
        }

        $O_userModel = new UserModel();

        if($O_userModel->isEmailInDatabase($S_email)){
            $S_errmsg = "An user with this email is already registered";
        }

        if(isset($S_errmsg)){
            return View::show("user/signup", array("success" => False, "msg" => $S_errmsg));
        }

        $S_password_hash = password_hash($S_password, PASSWORD_DEFAULT);

        $O_userModel->createUser($S_email, $S_username, $S_password_hash);
        return View::show("user/signup", array("success" => True));   
    }


    public function logoutAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        Session::destroy();
        header("Location: /");
    }

    public function viewAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        if(count($A_urlParams)!=0){
            return View::show("errors/404");
        }

        Session::login_or_die();

        return View::show("user/view", $A_user);
    }
}
