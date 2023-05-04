<?php

/**
 * @package [Mod] modapi
 * @author Machine
 * @copyright Copyright &copy; 2016, https://ogsteam.eu/
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 */ 


if (!defined('IN_SPYOGAME'))
    die("Hacking attempt"); // Pas d'accès direct
require_once("views/page_header.php");

require_once("mod/api/core/webApi.php");
require_once("mod/api/model/token.php");
include "mod/api/views/css.php";
//include "mod/api/views/menu.php";
//include "mod/api/views/definition.php";
if (!isset($pub_subaction)) {
    $pub_subaction = "index";
}

$user_id = $user_data["user_id"];
$menu_active_index = "";
$menu_active_reglage = "";
$menu_active_definition = "";
$menu_active_token = "";

switch ($pub_subaction) {
    case "index":
        $menu_active_index = "active";
        include "mod/api/views/menu.php";
        include "mod/api/views/index.php";
        break;
    case "definition":
        $menu_active_definition = "active";
        include "mod/api/views/menu.php";
        include "mod/api/views/definition.php";
        break;
    case "token":
        // gestion des demandes
        if (isset($pub_prolong) && isset($pub_name)) { // prolongation du token 
            (new modapi_token())->prolong_token($user_id, $pub_name);
        }
        if (isset($pub_renew) && isset($pub_name)) { // renouvellement du token 
            (new modapi_token())->renew_token($user_id, $pub_name);
        }
        if (isset($pub_delete) && isset($pub_name)) {
            // suppression du token 
            (new modapi_token())->delete_token($user_id, $pub_name);
        }
        if (isset($pub_create)) { // un nouveau 
            (new modapi_token())->add_token($user_id);
        }


        $menu_active_token = "active";
        include "mod/api/views/menu.php";
        include "mod/api/views/token.php";
        break;
    case "reglage":
        $menu_active_reglage = "active";
        include "mod/api/views/menu.php";
        include "mod/api/views/reglage.php";
        break;
    default :
        $menu_active_index = "active";
        include "mod/api/views/menu.php";
        include "mod/api/views/index.php";
        break;
}

require_once("views/page_tail.php");
