<?php

/**
 * @package [Mod] modapi
 * @author Machine
 * @copyright Copyright &copy; 2016, https://ogsteam.eu/
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 */ 


if (!defined('IN_SPYOGAME'))
    die("Hacking attempt");

$security = false;
$mod_folder = "api";
$security = install_mod($mod_folder);
if ($security == true) {
    global $db;

    $sql = " CREATE TABLE If NOT EXISTS ogspy_tokens ( ";
    $sql .= " token_id varchar(64) NOT NULL , ";
    $sql .= " token_user_id INT NOT NULL DEFAULT '0',  ";
    $sql .= " token_expire INT NOT NULL DEFAULT '0',  ";
    $sql .= " token_type varchar(32) NOT NULL  DEFAULT '0', ";
    $sql .= " UNIQUE KEY  (token_id,token_user_id) ) ;";

    $db->sql_query($sql);





	
   
}



