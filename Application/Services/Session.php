<?php
////////////////////////////////////////////////////////////////////////////////
//                     ___  ____  _____ _____ ____  _                         //
//                    / ___||  _ \| ____| ____|  _ \( )_   _ _ __             //
//                    \___ \| |_) |  _| |  _| | | | |/| | | | '_ \            //
//                    ___) |  __/| |___| |___| |_| | | |_| | |_) |            //
//                   |____/|_|   |_____|_____|____/   \__,_| .__/             //
//                                                        |_|                 //
////////////////////////////////////////////////////////////////////////////////
namespace Services;

/**
 * Prefix sessions with useful methods.
 */
class Session
{
    /**
     * Determine if session has started.
     *
     * @var boolean
     */
    private static $sessionStarted = false;

    /**
     * if session has not started, start sessions
     */
    public static function init()
    {
        if (self::$sessionStarted == false) {
            session_start();
            self::$sessionStarted = true;
        }
    }

    /**
     * Add value to a session.
     *
     * @param string $key   name the data to save
     * @param string $value the data to save
     */
    public static function set($key, $value = false)
    {
        /**
        * Check whether session is set in array or not
        * If array then set all session key-values in foreach loop
        */
        if (is_array($key) && $value === false) {
            foreach ($key as $name => $value) {
                $_SESSION[$name] = $value;
            }
        } else {
            $_SESSION[$key] = $value;
        }
    }

    /**
     * Extract item from session then delete from the session, finally return the item.
     *
     * @param  string $key item to extract
     *
     * @return mixed|null      return item or null when key does not exists
     */
    public static function pull($key)
    {
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $value;
        }
        return null;
    }

    /**
     * Get item from session.
     *
     * @param  string  $key       item to look for in session
     * @param  boolean $secondkey if used then use as a second key
     *
     * @return mixed|null         returns the key value, or null if key doesn't exists
     */
    public static function get($key, $secondkey = false)
    {
        if ($secondkey == true) {
            if (isset($_SESSION[$key][$secondkey])) {
                return $_SESSION[$key][$secondkey];
            }
        } else {
            if (isset($_SESSION[$key])) {
                return $_SESSION[$key];
            }
        }
        return null;
    }

    /**
     * id
     *
     * @return string with the session id.
     */
    public static function id()
    {
        return session_id();
    }

    /**
     * Regenerate session_id.
     *
     * @return string session_id
     */
    public static function regenerate()
    {
        session_regenerate_id(true);
        return session_id();
    }

    /**
     * Return the session array.
     *
     * @return array of session indexes
     */
    public static function display()
    {
        return $_SESSION;
    }


    /**
     * Empties and destroys the session.
     *
     * @param  string $key - session name to destroy
     * @param  boolean $prefix - if set to true clear all sessions for current SESSION_PREFIX
     *
     */
    public static function destroy($key = '', $prefix = false)
    {
        /** only run if session has started */
        if (self::$sessionStarted == true) {
            /** if key is empty and $prefix is false */
            if ($key =='' && $prefix == false) {
                session_unset();
                session_destroy();
            } elseif ($prefix == true) {
                /** clear all session for set SESSION_PREFIX */
                foreach($_SESSION as $key => $value) {
                    if (strpos($key, SESSION_PREFIX) === 0) {
                        unset($_SESSION[$key]);
                    }
                }
            } else {
                /** clear specified session key */
                unset($_SESSION[$key]);
            }
        }
    }

    /**
     *
     *
      * @return string return the message inside div
     */

}
