<?php
/**
 * Crée par Nicolas RAMOS.
 * User: Nicolas
 * Date: 21/09/2016
 * Description: ${DESCRIPTION}
 */
namespace Models;

use \Illuminate\Database\Capsule\Manager as DB;
use \Illuminate\Database\Eloquent\Model as Model;

class AccountModel extends Model {

    public function getSalt($username){
        $salt = DB::table("Utilisateur")->where("login_user", "=", $username)->value("salt_user");
        return $salt;
    }
    public function checkCredential($username, $pass)
    {
        $query = DB::table("Utilisateur")->where('login_user', '=', $username)->where('mdp_user', "=", $pass)->get();
        if(!$query)
        {
            return false;
        } else {
            return true;
        }
    }
    public function add($salt, $pass, $user){
        $query = DB::table('Utilisateur')->insert(
            ['login_user' => $user, 'salt_user' => $salt,
                'mdp_user' => $pass,
                'grade_user' => 1
            ]
        );
}
}