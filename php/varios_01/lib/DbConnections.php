<?php

/**
 * Manages a single connections to multiple DBs 
 */
class DbConnections {
    
    // Knowns DB Connections
    private $DB1;
    private $DB2;
    
    private function realConnect2Db($type="primary"){
        // Here use mysqli / PDO / Adodb, your preference method of connection to DB
        return true;
    }

    public function DBconnect1(){
        if(!$this->DB1){
            $this->DB1 = $this->realConnect2Db("primary");
        }
        return $this->DB1;
    }
    
    public function DBConnect2(){
        if(!$this->DB2){
            $this->DB2 = $this->realConnect2Db("secondary");
        }
        return $this->DB2;
    }

    /**
     * Here N DBConnectX() methods found ... For each one you have set a private property
     */
    
}
