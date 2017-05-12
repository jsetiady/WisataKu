<?php
namespace WisataKu\WisataKuAPI;
class Util {
    
    //Array of Object to multidimension array
    public function objectsToArray($objects) {
        $arr = array();
        foreach ($objects as $obj):
            array_push($arr, $obj->toArray());
        endforeach;
        return $arr;
    }

    function utf8ize($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = $this->utf8ize($v);
            }
        } else if (is_string ($d)) {
            return utf8_encode($d);
        }
        return $d;
    }
}