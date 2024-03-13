<?php
namespace App\Data;

class CleanData{

    public static function transformTo($str,$to="lower"){
        $result = "";

        if($to=="lower"){
            $result = strtolower($str);
        }

        if($to=="upper"){
            $result = strtoupper($str);
        }
        return $result;
    }

}