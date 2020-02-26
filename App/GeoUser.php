<?php


namespace App;


class GeoUser
{

    protected  $ip = "unknown";

    protected function get_ip_user(){

        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
        {
            $this->ip = getenv("HTTP_CLIENT_IP");
        }
        else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
        {
            $this->ip = getenv("HTTP_X_FORWARDED_FOR");
        }
        else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
        {
            $this->ip = getenv("REMOTE_ADDR");
        }
        else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'],

                "unknown"))
        {
            $this->ip = $_SERVER['REMOTE_ADDR'];
        }

        return $this->ip;
    }

    function get_data_user(){

        $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$this->get_ip_user()));
        if($query && $query['status'] === 'success'){
            return $query;
        }
    }
}