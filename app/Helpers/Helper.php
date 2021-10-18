<?php

namespace App\Helpers;

class Helper{

    /**
     * Convert Array to Class Instance
     * @param $array
     * @param $class
     * @return array
     */
    public static function arrayToInstance($array, $class){
        $instance = [];
        foreach ($array as $key => $item){
            $instance[$key] = new $class(...$item);
        }
        return $instance;
    }

}
