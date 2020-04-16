<?php

namespace Core;

class Session
{

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        if(Isset($_SESSION[$key]))
            return $_SESSION[$key];
        return false;
    }

    public static function destroy($keys)
    {
        if(strpos(json_encode($keys), "{"))
            foreach($keys as $key)
                unset($_SESSION[$key]);     
        unset($_SESSION[$keys]);
    }
}