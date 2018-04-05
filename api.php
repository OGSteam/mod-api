<?php
/**
 * Created by PhpStorm.
 * User: machine
 * Date: 04/04/2018
 * Time: 06:46
 *
 */
define('IN_SPYOGAME', true);
date_default_timezone_set(date_default_timezone_get());

//positionnement au niveau de lindex opour les include (cf xtense implementation)
if (preg_match('#mod#', getcwd())) chdir('../../');
$_SERVER['SCRIPT_FILENAME'] = str_replace(basename(__FILE__), 'index.php', preg_replace('#\/mod\/(.*)\/#', '/', $_SERVER['SCRIPT_FILENAME']));
include("common.php");

//include
require_once("mod/api/core/response.php");
require_once("mod/api/core/webApi.php");
require_once("mod/api/model/User_Model.php");
require_once("mod/api/model/Tokens_Model.php");
require_once("includes/token.php");

//fin include


var_dump($pub_user);
var_dump($pub_pass);



$web_api = new webApi();
$web_api->authenticate_by_user($pub_user,$pub_pass);




//$u=new  Ogsteam\Ogspy\Model\User_Model();
//var_dump($u->select_user_login($pub_user, $pub_pass));


?>
test

