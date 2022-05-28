#!/usr/bin/php
<?php

error_reporting(-1);
ini_set("display_errors", 1);

include_once "randomize.php";

$oRand=new Randomize();

$min=1;
$max=1000;
for($i=1; $i<=10; $i++){
    $i_iddom = $oRand->GetRandom($min, $max);
    echo "Random Number: $i_iddom\n";
}

$string="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
for($i=1; $i<=10; $i++){
    $s_rand = $oRand->GetRandomCharOfString($string);
    echo "Random Letter: $s_rand\n";
}
