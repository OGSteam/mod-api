<?php

/**
 * @package [Mod] modapi
 * @author Machine
 * @copyright Copyright &copy; 2016, https://ogsteam.eu/
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 */ 



if (!defined('IN_SPYOGAME')) die("Hacking attempt");

$modname = "api";
$filename = 'mod/api/version.txt';
if (file_exists($filename)) $file = file($filename);

$security = false;
$security = update_mod($modname,$modname);

if ($security == true){
// nothing
  
}

?>
