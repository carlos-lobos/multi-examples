#!/usr/bin/php
<?php

function openfiledescriptor($file, $compressed, $mode="rb"){
    if(!$compressed){
        $fp=fopen($file, $mode);
    } else {
        //$fp=gzopen($file, $mode);
        $fp=fopen("compress.zlib://".$file, $mode);
    }
    return $fp;
}

$s_origen=$_SERVER["argv"][1];
$s_destino=$_SERVER["argv"][2];

if(!file_exists($s_origen)){
    echo "[ERROR] El archivo origen no existe.\n";
    exit(1);
}

if(file_exists($s_destino)){
    echo "[ERROR] El archivo destino existe.\n";
    exit(1);
}

$orig_compress=(substr($s_origen,-2)=="gz")?true:false;
$dest_compress=(substr($s_destino,-2)=="gz")?true:false;

$fp_orig=openfiledescriptor($s_origen, $orig_compress);
$fp_dest=openfiledescriptor($s_destino, $dest_compress, "a");

while (!feof($fp_orig)) {
    $tmp_contents = fread($fp_orig, 10485760); // 10485760 bytes == 10 MB
    if(fwrite($fp_dest, $tmp_contents)===false){
        echo "[ERROR] No se pudo escribir el destino.\n";
        break;
    }
    usleep(1000);
}

fclose($fp_orig);
fclose($fp_dest);

$ts=filemtime($s_origen);
touch($s_destino, $ts);
