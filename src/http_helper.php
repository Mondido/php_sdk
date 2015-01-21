<?php namespace mondido;


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

    public static function delete($uname,$pass,$url){
        $opts = array(
            'http'=>array(
                'method'=>"DELETE",
                'header' => "Authorization: Basic " . base64_encode("$uname:$pass")
            )
        );
        $context = stream_context_create($opts);
        $file = file_get_contents($url, false, $context);
        return json_decode($file, TRUE);
    }

    public static function post($uname,$pass,$url,$data){
        $body = http_build_query($data);
        $opts = array(
            'http'=>array(
                'method'=>"POST",
                'header' => array(
                    "Authorization: Basic " . base64_encode("$uname:$pass"),
                     "Content-type: application/x-www-form-urlencoded",
                     "Content-Length: " . strlen($body)
                ),
                'content' => $body
            )
        );


        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($body));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_USERPWD, "$uname:$pass");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);

        return json_decode($result, TRUE);
    }

}