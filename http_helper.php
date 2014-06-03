<?php
/**
 * Created by JetBrains PhpStorm.
 * User: robertpohl
 * Date: 03/06/14
 * Time: 17:37
 * To change this template use File | Settings | File Templates.
 */

namespace mondido;


class http_helper {

    public static function get($uname,$pass,$url){
        $opts = array(
            'http'=>array(
                'method'=>"GET",
                'header' => "Authorization: Basic " . base64_encode("$uname:$pass")
            )
        );
        $context = stream_context_create($opts);
        $file = file_get_contents($url, false, $context);
        return json_decode($file, TRUE);
    }

    public static function post($uname,$pass,$url,$data){
        $opts = array(
            'http'=>array(
                'method'=>"POST",
                'header' => "Authorization: Basic " . base64_encode("$uname:$pass"),
                'content' => http_build_query($data),
            )
        );
        $context = stream_context_create($opts);
        $file = file_get_contents($url, false, $context);
        return json_decode($file, TRUE);
    }

}