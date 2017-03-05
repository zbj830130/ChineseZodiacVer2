<?php
/**
 * Session helper
 */
class SessionHelper{

    /**
     * set session
     * @param String $name   session name
     * @param Mixed  $data   session data
     * @param Int    $expire million
     */
    public static function set($name, $data, $expire=1200){
        $session_data = array();
        $session_data['data'] = $data;
        $session_data['expire'] = time()+$expire;
        $_SESSION[$name] = $session_data;
    }

    /**
     * get session
     * @param  String $name  session name
     * @return Mixed
     */
    public static function get($name){
        if(isset($_SESSION[$name])){
            if($_SESSION[$name]['expire']>time()){
                return $_SESSION[$name]['data'];
            }else{
                self::clear($name);
            }
        }
        return false;
    }

    /**
     * claer session
     * @param  String  $name  session name
     */
    public static function clear($name){
        unset($_SESSION[$name]);
    }

}
?>