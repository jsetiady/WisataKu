<?php
namespace WisataKu\WisataKuAPI;
class Util {
    
    //Array of Object to multidimension array
    public function objectsToArray($objects) {
        $arr = array();
        foreach ($objects as $obj):
            array_push($arr,$obj->toArray());
        endforeach;
        return $arr;
    }
}