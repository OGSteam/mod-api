<?php

if (!defined('IN_SPYOGAME')) {
    die("Hacking attempt");
}

class modapi_players {

    private function getAllPlayersResult($params) {
        global $db;
        
        $request = "SELECT * FROM " . TABLE_GAME_PLAYER. " ";
        $request .= "WHERE player_id != \"0\"  ";
        $request .= isset($params["player"]) ? "AND player like \"%".$params["player"]."%\" ": " ";
        $request .= isset($params["status"]) ? "AND status like \"%".$params["status"]."%\" ": " ";
        
        $result = $db->sql_query($request);

        return $result;
    }

    public function getAllPlayers($params) {
        global $db;

        $result = $this->getAllPlayersResult($params);

        $retour = array();
        while ($row = $db->sql_fetch_assoc($result)) {
            $retour[] = $row;
        }
        return $retour;
    }

    public function getAllPlayersAssocIDPlayer() {
        global $db;
        $result = $this->getAllPlayersResult();

        $retour = array();

        while ($row = $db->sql_fetch_assoc($result)) {
            $retour[$row['player_id']] = $row;
        }
        return $retour;
    }

    public function getAllPlayersAssocIDAlly() {
        global $db;
        $result = $this->getAllPlayersResult();

        $retour = array();

        while ($row = $db->sql_fetch_assoc($result)) {
            $retour[$row['ally_id']] = $row;
        }
        return $retour;
    }

}
