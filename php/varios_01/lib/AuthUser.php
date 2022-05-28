<?php

/**
 * Load authenticated user data only once
 */
class AuthUser {
    
    // Authentication User Data
    private $s_username;
    private $s_remote_ip;
    
    public function __construct() {
        $this->s_username = htmlspecialchars(isset($_SERVER['PHP_AUTH_USER'])?$_SERVER['PHP_AUTH_USER']:"");
        $this->s_remote_ip = htmlspecialchars(isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:"");
    }

    // Authentication User Data
    public function GetUsername(){
        return $this->s_username;
    }
    
    public function GetRemoteIp(){
        return $this->s_remote_ip;
    }
    
}
