<?php
/**
 * Created by PhpStorm.
 * User: machine
 * Date: 02/04/2018
 * Time: 18:36
 */
if (!defined('IN_SPYOGAME')) die("Hacking attempt");
class response
{
    private $code = 200;
    private $contentType ="json";
    private $cacheControl = 0;
    private $charset = "UTF-8";

    private $codeAutorize = array(
        200 => '200 OK',
        400 => '400 Bad Request',
        401 => 'Unauthorized',
        500 => '500 Internal Server Error'
    );


    /**
     * response constructor.
     * @param string $type format d'echange de donnée
     * @param int $cache temps en seconde de mise en cache par defaut 0
     */
    function __construct($type = 'json' , $cache = 0)
    {
        $this->setContentType($type);
        $this->setContentType($cache);

    }

    /**
     * @param $type string force le type de fichier retourné
     */
    public function setContentType($type)
    {
        $possibleValue = array('json');
        if(!in_array($type,$possibleValue) )
        {
            $type = $possibleValue[0];
        }
        $this->contentType=$type;

    }


    /**
     * @param $type string force le type de fichier retourné
     *
     * Attention si le code nexiste pas ou n'est pas prévu on generer une erreur
     * @url https://fr.wikipedia.org/wiki/Liste_des_codes_HTTP
     *
     *  200 => '200 OK',
     *  400 => '400 Bad Request',
     *  401 => 'Unauthorized',
     *  500 => '500 Internal Server Error'
     *
     */
    public function setCode($code)
    {
              if(!array_key_exists($code ,$this->codeAutorize ))
        {
            $this->code=500;
        }
        else{
            $this->code=$code;
        }
    }

    /**
     * @param int $cache temps de mise en cache en seconde
     */
    public function setCache($cache)
    {

        $cache = (int)$cache;
        $this->cacheControl = $cache;
           }


    /**
     * @param $data deja dans le format de reponse (json/xml/ ....)
     *
     * si code erreur ne retournera rien
     */
    public function sendResponse($data)
    {
        //raz header
        header_remove();
        //coderetour
        http_response_code($this->code);
        header('Status: '.$this->codeAutorize[$this->code]);
        if ($this->code> 299)
        {
            die(); // fin

        }

        //type
        header("Content-type: application/".$this->contentType."; charset=".$this->charset);
        //temps de cache si necessaire
        if ($cache=0)
        {
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
        }
        else
        {
            $ts = gmdate("D, d M Y H:i:s", time() + $this->cacheControl) . " GMT";
            header("Expires: $ts");
            header("Pragma: cache");
            header("Cache-Control: max-age=$this->cacheControl");
        }


        echo $data;

        die();
    }






}
