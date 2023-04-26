<?php

if (!defined('IN_SPYOGAME'))
    die("Hacking attempt"); // Pas d'accès direct
require_once("views/page_header.php");

require_once("mod/api/core/webApi.php");

include "mod/api/views/css.php";
//include "mod/api/views/menu.php";
//include "mod/api/views/definition.php";
if (!isset($pub_subaction)) {
    $pub_subaction = "index";
}

$menu_active_index = "";
$menu_active_reglage = "";
$menu_active_definition = "";

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
    case "reglage":
        $menu_active_reglage = "active";
        include "mod/api/views/menu.php";
        break;
    default :
        $menu_active_index = "active";
        include "mod/api/views/menu.php";
        include "mod/api/views/index.php";
        break;
}

require_once("views/page_tail.php");
