<?php

/**
 * Example of calculus of Reverse IP
 */

function reverseIpV4($ip, $fullreverse=false){
    $pieces_ip = explode(".", $ip);
    if ($fullreverse) {
            return  $pieces_ip[3] . "." . $pieces_ip[2] . "." . $pieces_ip[1] . "." . $pieces_ip[0] . ".in-addr.arpa";
    } else {
        return  $pieces_ip[2] . "." . $pieces_ip[1] . "." . $pieces_ip[0] . ".in-addr.arpa";
    }
}

function reverseIpV6($ip, $fullreverse=false){
    $addr = inet_pton($ip);
    $unpack = unpack('H*hex', $addr);
    $hex = $unpack['hex'];
    $reverso = array_reverse(str_split($hex));

    if (!$fullreverse) {
        $partes = array_slice($reverso, 20); 
    } else {
        $partes = $reverso;
    }

    return  implode('.', $partes) . '.ip6.arpa';
}


$ip="127.0.0.1";
$revip_part=reverseIpV4($ip);       // DNS Zone Domain
$revip_full=reverseIpV4($ip, true); // DNS Zone Record A for the Domain
var_dump($revip_part, $revip_full);

$ip="::1"; // Equivalent to 127.0.0.1
$revip_part=reverseIpV6($ip);       // DNS Zone Domain
$revip_full=reverseIpV6($ip, true); // DNS Zone Record A for the Domain
var_dump($revip_part, $revip_full);
