<?php

final class UserController
{

    public function loginAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        View::show("user/login");
    }

    public function registerAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        View::show("user/register");
    }

    private function get_or_die($DICT, $key)
    {
        if (isset($DICT[$key])) return $DICT[$key];
        else die("Key $key not present");
    }

    public function signInAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $S_username = self::get_or_die($A_postParams, "username");
        $S_password = self::get_or_die($A_postParams, "password");

        $O_userModel = new UserModel();
        if ($O_userModel->isPasswordValid($S_username, $S_password)) {
            View::show("user/signin", array("success" => True));
        } else {
            View::show("user/signin", array("success" => False));
        }
    }

    public function signUpAction(Array $A_urlParams = null, Array $A_postParams = null)
    {
        $S_username = self::get_or_die($A_postParams, "username");
        $S_password = self::get_or_die($A_postParams, "password");

        if ( strlen($S_username) < 4 || strlen($S_username) > 16 ) {
            $S_errmsg = "username must be between 4 and 16 characters";
        } else if(!ctype_alnum($S_username)) {
            $S_errmsg = "username must be alphanumeric";
        } else if( strlen($S_password) < 8 || strlen($S_username) > 150 ) {
            $S_errmsg = "password must be between 8 and 150 characters";
        }

        $O_userModel = new UserModel();

        if($O_userModel->isUserInDatabase($S_username)){
            $S_errmsg = "An user with this name is already registered";
        }

        if(isset($S_errmsg)){
            return View::show("user/signup", array("success" => False, "msg" => $S_errmsg));
        }

        $S_password_hash = password_hash($S_password, PASSWORD_DEFAULT);

        $O_userModel->createUser($S_username, $S_password_hash);
        return View::show("user/signup", array("success" => True));
        
        
    }
}
