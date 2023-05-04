<?php

/**
 * @package [Mod] modapi
 * @author Machine
 * @copyright Copyright &copy; 2016, https://ogsteam.eu/
 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
 */ 

if (!defined('IN_SPYOGAME')) {
    die("Hacking attempt");
}

use Ogsteam\Ogspy\Model\Tokens_Model;

class modapi_token {

    private const TYPE = "modapi";

    public function isExist($id) {
        // on recherche les tokens existants
        $tokens = $this->get_modapi_tokens($id);
        if (count($tokens) != 0) {
            return true;
        }
        return false;
    }

    public function get_modapi_tokens($id) {
        $t = new Tokens_Model();
        $allToken = $t->get_all_tokens($id);
        // nous ne retournons que les tokens correspondant au mod
        $retour = array();
        foreach ($allToken as $modapiToken) {
            if (str_contains($modapiToken["name"], (string) $this::TYPE)) {
                $retour[$modapiToken["name"]] = $modapiToken;
            }
        }
        return $retour;
    }

    public function add_token($user_id) {
        $t = new Tokens_Model();

        $new_token = bin2hex(random_bytes(32));
        $validity = $this->validityToken(); // a rendre modifiable

        $t->add_token($new_token, (int) $user_id, $validity, (string) $this::TYPE . "_" . time());

        return ($new_token);
    }

    public function prolong_token($user_id, $name) {
        $tokens = $this->get_modapi_tokens($user_id);
        if (isset($tokens[$name])) {
            (new Tokens_Model())->add_token($tokens[$name]["token"], (int) $user_id, $this->validityToken(), $tokens[$name]["name"]);
        }
    }

    public function renew_token($user_id, $name) {
        $tokens = $this->get_modapi_tokens($user_id);
        if (isset($tokens[$name])) {
            (new Tokens_Model())->add_token($this->genRndToken(), (int) $user_id, $this->validityToken(), $tokens[$name]["name"]);
        }
    }

     public function delete_token($user_id, $name) {
        $tokens = $this->get_modapi_tokens($user_id);
        if (isset($tokens[$name])) {
            $t = new Tokens_Model();
            $t->add_token($tokens[$name]["token"], (int) $user_id, $this->validityToken(0), $tokens[$name]["name"]);
            $t->delete_expired_tokens();
        }
    }

    private function genRndToken() {
        return bin2hex(random_bytes(32)); // cf page profil ogspy
    }

    private function validityToken($days = 365) {
       if ($days == 0 )
       {
           return 1;
       }
        return time() + ($days * 24 * 60 * 60); // a rendre modifiable
    }

}
