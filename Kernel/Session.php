<?php

final class Session
{
    public static function start_session()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function resume_session()
    {
        if(self::has_session_cookie()){
            self::start_session();
            return true;
        }
        return false;
    }

    public static function destroy_session()
    {
        self::start_session();
        session_destroy();
    }

    /*
        Reason: start_session() automatically sets a cookie,
        we want a way to know if the user have a session without setting a cookie
        (e.g to not set a cookie on every page to set the header, which change if you are logged-in)
    */
    public static function has_session_cookie()
    {
        return isset($_COOKIE[session_name()]);
    }
    
    public static function is_login()
    {
        if (!self::resume_session()) {
            return false;
        }
        if (!isset($_SESSION)) {
            return false;
        }
        if (!isset($_SESSION["ID"])) {
            return False;
        }
        
        // ensure account has not been deleted/disabled in the meantime
        $O_userModel = new UserModel();
        $B_userActive = $O_userModel->isUserActive($_SESSION["ID"]);
        return $B_userActive;
    }

    public static function set_login($I_id){
        self::start_session();
        $_SESSION["ID"] = $I_id;
    }

    public static function login_or_die()
    {
        if (!self::is_login()) {
            header("Location: /user/login?return_uri=".$_SERVER["REQUEST_URI"]);
            die();
        }
    }
}
