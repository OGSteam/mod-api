<?php

/**
 * Created by PhpStorm.
 * User: machine
 * Date: 04/04/2018
 * Time: 06:46
 */
if (!defined('IN_SPYOGAME'))
    die("Hacking attempt");

class webApi {

    // retourne la liste exhaustife des demandes possibles
    public static function getDefinition() {
        $def = array();
        $help = array();
        $help["description"] = "Liste les possibilités de l'api";
        $help["arguments"] = array(); // preparation arguments
        $def["help"] = $help; //ressource player   
        // Ressource joueur(s)
        //arguments possibles
        $players = array();
        $players["descriptions"] = "Retourne la liste des joueurs";
        $players["arguments"] = array(); // preparation arguments
        $players["arguments"]["player"] = array('cast' => "string", 'required' => false, 'min' => 0, 'max' => 10, 'description' => "Nom du joueur recherché"); // argument 
        $players["arguments"]["status"] = array('cast' => "string", 'required' => false, 'min' => 0, 'max' => 3, 'description' => "Status du joueur recherché"); // argument 
        $def["players"] = $players; //ressource player   

        return $def;
    }

    public function call($fnName, $params = array()) {
        // mis en conformité des parametres
        $tmpParams = array();
        $def = self::getDefinition();

        foreach ($params as $keyParam => $valueParam) {
            // verifiaction presence du parametre demandé
            if (isset($def[$fnName]["arguments"][$keyParam])) {
                // cast et clamp
                $min = $def[$fnName]["arguments"][$keyParam]["min"];
                $max = $def[$fnName]["arguments"][$keyParam]["max"];
                $cast = $def[$fnName]["arguments"][$keyParam]["cast"];
                if (!is_null(utils::cast($cast, $valueParam))) {
                    $tmpParams[$keyParam] = utils::cast($cast, $valueParam);
                    $tmpParams[$keyParam] = utils::clamp($cast, $tmpParams[$keyParam], $min, $max);
                }
            }
        }

        // on peut appeler la fonction 
        try {
            $retour = $this->$fnName($tmpParams);
            return $retour;
        } catch (Exception $e)
        {
            return null;
        }
    }


    private function players($params) {
        $players = new player();
        return $players->getAllPlayers($params);
    }

    //retourne les definitions   
    private function help() {
        return self::getDefinition();
    }

}
