<?php

require_once 'DbConnections.php';
require_once 'AuthUser.php';

/**
 * Collection of Global Objects
 */
class GlobalObjects {
    
    private $oDbConns;
    private $oAuthUser;
    
    public function GetAuthUserObj(){
        if(!$this->oAuthUser){
            $this->oAuthUser = new Authuser();
        }
        return $this->oAuthUser;
    }
    
    public function GetDbConnsObj(){
        if(!$this->oDbConns){
            $this->oDbConns = new DbConnections();
        }
        return $this->oDbConns;
    }
    
}

$GLOBALS['GO'] = new GlobalObjects();
