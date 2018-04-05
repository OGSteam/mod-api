<?php


if (!defined('IN_SPYOGAME')) die("Hacking attempt");

$mod_uninstall_name = "api";

global $db;
uninstall_mod($mod_uninstall_name,null);
$sql = " DROP TABLE IF EXISTS ogspy_tokens ;";

$db->sql_query($sql);

 
?>
