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

    //debug
    //retour le json passé en argument
    public function customData($data)
    {
        $response = new response();
        $response->sendResponse($data);

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


    /**
     * Entry point for API commands
     * This function will call the required and private function to get the requested data
     * @param $data
     */
    public function api_treat_command($data) {
        $data_decoded = json_decode($data, true);
        switch ($data_decoded['cmd']) {
            case "ogspy_server_details" :
                $this->api_send_ogspy_server_details();
                break;
            case "ogspy_ally_details" :
                $this->api_send_ogspy_ally_details();
                break;
            case "ogspy_user_details" :
                $this->api_send_ogspy_player_details();
                break;
            case "ogspy_rank_by_date" :
                $this->api_send_ogspy_rank_by_date($data_decoded['type'], $data_decoded['higher_rank'], $data_decoded['lower_rank']);
            case "ogspy_rank_all" :
                $this->api_send_ogspy_all_rank($data_decoded['type']);
            case "api_send_ogspy_spy" :
                $this->api_send_ogspy_spy($data_decoded['since']);
            default:
                break;
        }
        //Cas envoyer liste paramètres utilisateurs.
        //$this->api_send_user_list();
    }



    /**
     * Fonction test envoi de données
     */
    private function api_send_ogspy_server_details() {
        if ($this->authenticated_token != null) {
            $data_config = new Ogsteam\Ogspy\Model\Config_Model();
            $data_config = $data_config->find_by(array("servername", "register_alliance", "allied", "url_forum"));
            $data = array('status' => 'ok', 'content' =>$data_config);
            $response = new response();
            $response->sendResponse(json_encode($data));
        }
    }
    /**
     * Fonction test envoi de données
     */
    private function api_send_ogspy_spy($since) {
        if ($this->authenticated_token != null) {
            $spy = new Ogsteam\Ogspy\Model\Spy_Model();
            //formatage date
           $date = new DateTime($since);
            $tSpy = $spy->get_SpySince($date->getTimestamp());
            $data = array('status' => 'ok', 'content' =>$tSpy);
            $response = new response();
            $response->sendResponse(json_encode($data));
        }




    }




}
