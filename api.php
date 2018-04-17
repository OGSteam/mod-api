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

//todo
//verifier serveur actif
//verifier mod actif
// mise en place de droit/user ???



//include
require_once("mod/api/core/response.php");
require_once("mod/api/core/webApi.php");
require_once("mod/api/model/User_Model.php");
require_once("mod/api/model/Tokens_Model.php");
require_once("mod/api/model/Config_Model.php");
require_once("mod/api/model/Spy_Model.php");
require_once("includes/token.php");

//si pas de demande : heure



$api = new webApi();
//pas de webservice si pas de ssl
if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on" )
{
    $api->nosecure();
}


if (isset($pub_login) && isset($pub_password)) {
    $api->authenticate_by_user($pub_login, $pub_password);
} elseif (isset($pub_token) && isset($pub_data)) {
    if ($api->authenticate_by_token($pub_token) === true) {
        //var_dump(json_decode($pub_data));die();
        $api->api_treat_command($pub_data);
    }
}



//si pas de demande : heure
$api = new webApi();
$api->customData(json_encode(array('status' => 'ok', 'time' => time())));



//die();


//$web_api = new webApi();
//$web_api->authenticate_by_user($pub_user,$pub_pass);






