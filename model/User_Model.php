<?php
/**
 * Database Model
 *
 * @package OGSpy
 * @subpackage Model
 * @author DarkNoon
 * @copyright Copyright &copy; 2016, http://ogsteam.fr/
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 3.4.0
 *
 * Fichier partiel, provient de la 3.4
 * transition future plus facile ? b
 *
 */

namespace Ogsteam\Ogspy\Model;
if (!defined('IN_SPYOGAME')) die("Hacking attempt");

class User_Model
{

    /* Fonctions concerning user account */
    /**
     * @param $login
     * @param $password
     * @return bool|mixed|mysqli_result
     *
     *
     * fonction modifié, 3.3 pas de
     */
    public function select_user_login($login, $password, $salt = false)
    {
        global $db;
        if ($salt === false) {
            //$password = Ogspy\crypto($password);
            $password =  md5(sha1($password));
        }

        $request = "SELECT `user_id`, `user_active` FROM " . TABLE_USER . " WHERE `user_name` = '" . $db->sql_escape_string($login) . "' AND `user_password` = '" . $password . "'";
        $result = $db->sql_query($request);

        return $result;
    }


}