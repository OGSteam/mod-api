<?php

class request {

    ///  exemple  :  api.php/players?name=machine&allyID=25
    private $uri;
    private $ressource;
    private $params = array();

    public function __construct() {
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->constructRessource();

        // récuperation des variables vérifiées (!non safe! ?)
        foreach ($_GET as $key => $value) {
            $pubValue = "pub_" . $key;
            global $$pubValue;
            $this->params[$key] = $$pubValue;
        }


        //   var_dump($_SERVER);
        // var_dump(get_defined_vars());
    }

    private function constructRessource() {
        $uri = explode('?', $this->uri)[0]; // on recupere URL
        $uri = str_replace('/api.php', '', $uri); // On elimine la constante

        $segments = explode('/', $uri);
        // le dernier element correspond a la ressource demandé
        $ressource = $segments[count($segments) - 1];
        $this->ressource = $ressource;
    }

    public function getRessource() {
        return $this->ressource;
    }

    public function getParams() {
        return $this->params;
    }

    public function isSecure() {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") {
            return true;
        }
        return false;
    }

}
