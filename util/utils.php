<?php

class utils {

    public static function cast($type, $data) {

        switch ($type) {
            case "int":
                $data = (int) $data;
                return $data;
            case "string":
                $data = (string) $data;
                return $data;
            default:
                return null;
        }
    }

    public static function clamp($type, $data, $min , $max) {

        switch ($type) {
            case "int":
                $data = (int)max($min, min($max, $data));
                return $data;
            case "string":
                $data = (string)substr($data,0,$max); // impossible de preciser un min 
                return $data;
            default:
                return null;
        }
    }

}
