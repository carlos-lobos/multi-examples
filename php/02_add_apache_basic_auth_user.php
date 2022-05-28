<?php

/**
 * Example how add a new user or modify the password of an existent user for apache basic authentication
 */

 /// WARNING: require htpasswd command (this is part of apache server)
function AddApacheBasicAuthUser($user, $pass, $basicAuthType="RETURN"){
    if(!in_array($basicAuthType, array("FILE", "RETURN"))){
        $basicAuthType = "RETURN";
    }

    $userQuoted = escapeshellarg($user);
    $passQuoted = escapeshellarg($pass);

    if($basicAuthType=="FILE"){
        $passwdFile = "/home/USUARIO/public/.passwd";
        $htcmd = "htpasswd -bm $passwdFile $userQuoted $passQuoted";
    } else {
        // $basicAuthType == "RETURN"
        $htcmd = "htpasswd -bmn $userQuoted $passQuoted";
    }

    $result = array();
    $status = 0;
    exec($htcmd, $result, $status);
    if ($status != 0) {
        return false;
    }

    $passEncrypted = "";
    if($basicAuthType=="FILE"){
        // Obtenemos el password, encriptado con MD5 de apache, desde el archivo
        $passEncrypted = trim(shell_exec("grep $userQuoted $passwdFile 2>/dev/null | cut -d: -f2"));
    } else {
        // $basicAuthType == "DATABASE"
        foreach($result as $line){
            $line=trim($line);
            if(strpos($line, "$user:")!==false){
                $passEncrypted=substr($line, strlen("$user:"));
                break;
            }
        }
    }

    // Armado de datos para el usuario.
    $data = array( 'encpass' => $passEncrypted );

    return $data;
}

$user="exampleuser";
$pass="examplepass";
$encpass = AddApacheBasicAuthUser($user, $pass);
var_dump($encpass);
