<?php

/**
 * Principal logic, check if user is authorized and get data from diferents DBs
 */

// Include and set global object collection $GO
include_once 'lib/GlobalObjects.php';

class PrincipalLogic {

    public $oDbConns;
    public $oAuthUser;

    public function __construct() {
        global $GO;
        $this->oDbConns = $GO->GetDbConnsObj();
        $this->oAuthUser = $GO->GetAuthUserObj();
    }

    private function checkAuthorization(){
        $s_logged_user=$this->oAuthUser->GetUsername();
        $s_logged_user_ip=$this->oAuthUser->GetRemoteIp();
        // Here check authorization logic is spected
        // WARNING: forced to True for test
        if($s_logged_user || $s_logged_user_ip || true){
            return true;
        }
        return false;
    }

    public function GetData() {
        // Check authorization
        if(!$this->checkAuthorization()){
            return false;
        }

        $db1 = $this->oDbConns->DBconnect1();
        $db2 = $this->oDbConns->DBconnect2();

        // Here use DB1 and DB2 connections for get the data you need

        // Fake data
        $aData = [
            ["name" => "Charles", "surname" => "Darwin" ],
            ["name" => "Karl", "surname" => "Marx" ],
            ["name" => "Karl", "surname" => "Jaspers" ],
        ];
        return $aData;
    }

}
