<?php
/**
 * Created by PhpStorm.
 * User: machine
 * Date: 04/04/2018
 * Time: 06:46
 */
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
class webApi
{
    private $device = "unknow";
    private $authenticated_token = false;
    private $user_id_token = false;
    private $expireTime = 3600;


    /**
     * @param $login
     * @param $password
     *
     * Todo check ip ?
     */
    public function authenticate_by_user($login, $password)
    {
        global $db;
        $data_user =  new  Ogsteam\Ogspy\Model\User_Model();
        $result = $data_user->select_user_login($login, $password);
        if (list($user_id, $user_active) = $db->sql_fetch_row($result)) {
            if ($user_active == 1) {
                //generation du token
                $t= new token();
                $generated_token = $t->getToken($this->expireTime,"webapi_".$user_id,false);
                $data_token = new Ogsteam\Ogspy\Model\Tokens_Model();
                $deviceType = "android";
                $private_token = $data_token->add_token($generated_token, $user_id, time() + $this->expireTime, $deviceType);
                $this->authenticated_token = $private_token;
                $this->user_id_token = $user_id;
                $this->device= $deviceType;
                $response = new response();
                $response->sendResponse(json_encode(array('status' => 'ok', 'api_token' => $private_token)));
                die();
            } else {
                $response = new response();
                $response->setCode(401);
                $response->sendResponse();

            }
            //On ne retourne rien pour masquer API
        }
        exit();
    }


    public function nosecure()
    {
        $response = new response();
        $response->sendResponse(json_encode(array('status' => 'unsecure')));
    }


    /**
     * @param $token
     * @return bool
     */
    public function authenticate_by_token($token) {
        $data_token = new Ogsteam\Ogspy\Model\Tokens_Model();
        $user_id = $data_token->get_userid_from_token($token);
        if ($user_id !== false) {
            $this->authenticated_token = $token;
            $this->user_id_token = $user_id;
            return true;
        } else {
            $feedback = array('status' => 'error_auth');
            $response = new response();
            $response->sendResponse(json_encode($feedback));
        }
        return false;
    }



}