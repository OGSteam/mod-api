<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt"); // Pas d'accès direct
require_once("views/page_header.php");
require_once("mod/api/model/Tokens_Model.php");
require_once("mod/api/model/Config_Model.php");
// attention en version 3.3.2 n 'existe pas encore
if (file_exists("includes/token.php")) {
    require_once("includes/token.php");
}
?>

<h2>API Ogspy</h2>







<?php
require_once("views/page_tail.php");
