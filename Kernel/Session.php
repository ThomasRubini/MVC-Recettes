<?php

final class Session
{
    public static function start($I_id)
    {
        session_start();
        $_SESSION["ID"] = $I_id;
    }

    public static function destroy()
    {
        session_start();
        session_destroy();
    }

    public static function has_session()
    {
        if (!isset($_SESSION)) {
            return false;
        }
        if (!isset($_SESSION["ID"])) {
            return False;
        }        
    }

    public static function is_login()
    {
        if (!has_session()) {
            return false;
        }

        // ensure account has not been deleted/disabled in the meantime
        $O_userModel = new UserModel();
        return $O_userModel->isUserActive($_SESSION["ID"]);

    }

    public static function login_or_die()
    {
        if (!self::has_session()) {
            header("Location: /user/login?return_uri=".$_SERVER["REQUEST_URI"]);
            die();
        }
    }
}
