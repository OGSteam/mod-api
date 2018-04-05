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
    private $unknown;
    private $authenticated_token = false;
    private $user_id_token = false;
    private $user_Id = 0;


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
                $generated_token = $t->getToken(600,"webapi_".$user_id,false);
                $data_token = new Ogsteam\Ogspy\Model\Tokens_Model();
                $deviceType = "android";
                $private_token = $data_token->add_token($generated_token, $user_id, time() + 3600, $deviceType);
                $this->authenticated_token = $private_token;
                $this->user_Id = $user_id;
                $this->unknown = $deviceType;
                //$this->send_response(array('status' => 'ok', 'api_token' => $private_token));
                var_dump(array('status' => 'ok', 'api_token' => $private_token));
                var_dump($this);
            } else {
                exit();
            }
            //On ne retourne rien pour masquer API
        }
        exit();
    }









}