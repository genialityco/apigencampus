<?php

namespace App\Services;

use Validator;


class StringHelpers 

{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param string $data
     *
     */
    public static function acronym(string $data)
    {
        $data = preg_replace("/[^A-Za-z0-9 ]/", '', $data);
        $data_test = explode(" ", $data); 
        $acronym = ""; 
        $tot_acronym = 0;
        if ($data_test && count($data_test)) { 
            foreach ($data_test as $w) { 
                if ($tot_acronym > 3) continue;
                $acronym .= isset($w[0]) ? $w[0] : "0"; 
                $tot_acronym ++; 
            } 
        }
        $acronym = str_pad($acronym, 4, "0");
        return $acronym;
        
    }
}
