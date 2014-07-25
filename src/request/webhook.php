<?php
/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 12/06/14
 * Time: 13:46
 * To change this template use File | Settings | File Templates.
 */

namespace mondido\request;


class webhook {
    public static function get($data=null){
        if($data==null){
            $data = 'php://input';
        }
        $raw_data = file_get_contents($data);
        if($raw_data != null){
            return json_decode($raw_data, TRUE);
        }
        return null;
    }

}