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
if (preg_match('#mod#', getcwd()))
    chdir('../../');
$_SERVER['SCRIPT_FILENAME'] = str_replace(basename(__FILE__), 'index.php', preg_replace('#\/mod\/(.*)\/#', '/', $_SERVER['SCRIPT_FILENAME']));
include("common.php");

//TODO serveur / mod actif
//TODO mise en place de droit/user ???
//
//TODO  token ?
//include
require_once("mod/api/core/response.php");
require_once("mod/api/core/request.php");
require_once("mod/api/core/webApi.php");

require_once("mod/api/util/utils.php");

require_once("mod/api/model/player.php");

$request = new request();
$response = new response();
$webapi = new webApi();

// si non secure exit
if (!$request->isSecure()) {
    $response::Unsecure();
}
$def = webApi::getDefinition();

// verification de lexistence de la ressource 
if (!isset($def[$request->getRessource()])) {
    $response::BadRequest();
    exit();
}



//verification de la presence de param obligatoire
if (isset($def[$request->getRessource()]["arguments"])) {
    foreach ($def[$request->getRessource()]["arguments"] as $key => $value) {
        if ((bool) $value["required"]) {
            // si l'info est demandé, on regarde si elle est en param
            if (!isset($request->getArgs()[$key])) {
                response::InternalError();
                exit();
            }
        }
    }
}


$retour = $webapi->call($request->getRessource(), $request->getParams());
if ($retour == false) {
    $response::BadRequest();
} else {
    response::sendResponse($retour);
}


response::InternalError();
exit();
