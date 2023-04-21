<?php

/**
 * Created by PhpStorm.
 * User: machine
 * Date: 02/04/2018
 * Time: 18:36
 */
if (!defined('IN_SPYOGAME')) {
    die("Hacking attempt");
}

class response {

    private static $codeAutorize = array(
         0 => 'unsecure',
        200 => '200 OK',
        400 => '400 Bad Request',
        401 => 'Unauthorized',
        500 => '500 Internal Server Error'
    );

    public static function sendResponse($data, $status = 200, $charset = 'utf-8') {
        header("Content-Type: application/json; charset={$charset}");
        http_response_code($status);
        echo json_encode($data);
        exit();
    }
    
    public static function Unsecure() {
        self::sendError(0);
    }
    

    public static function Unauthorized() {
        self::sendError(401);
    }

    public static function BadRequest() {
        self::sendError(400);
    }

    public static function InternalError() {
        self::sendError(500);
    }

    private static function sendError($status = 500) {
        

        if (!isset(self::$codeAutorize[$status])) {
            $status = 500;
        }

        $errorMSG = [
            'error' => true,
            'message' => self::$codeAutorize[$status]
        ];
        

        response::sendResponse($errorMSG, $status);
    }

}
