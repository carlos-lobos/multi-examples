#!/usr/bin/php
<?php

$sleepDurationSeconds=isset($_SERVER["argv"][1])?$_SERVER["argv"][1]:1;

$previousStats=shell_exec("cat /proc/stat");

sleep($sleepDurationSeconds);

$currentStats=shell_exec("cat /proc/stat");

preg_match_all('/cpu./', $currentStats, $a_matches);
$cpus=$a_matches[0];

function getline($search, $stats){
    preg_match("/$search .*/", $stats, $a_m);
    return $a_m[0];
}

$a_info=array();

foreach($cpus as $cpu){
    $currentLine=getline($cpu, $currentStats);
    list($_CPUc,$user,$Nice,$system,$idle,$iowait,$irq,$softirq,$steal,$guest,$guest_Nice)=preg_split("/ /", $currentLine, -1, PREG_SPLIT_NO_EMPTY);

    $previousLine=getline($cpu, $previousStats);
    list($_CPUp,$prevuser,$prevnice,$prevsystem,$previdle,$previowait,$previrq,$prevsoftirq,$prevsteal,$prevguest,$prevguest_Nice)=preg_split("/ /", $previousLine, -1, PREG_SPLIT_NO_EMPTY);

    $PrevIdle=$previdle+$previowait;
    $Idle=$idle+$iowait;

    $PrevNonIdle=$prevuser+$prevnice+$prevsystem+$previrq+$prevsoftirq+$prevsteal;
    $NonIdle=$user+$Nice+$system+$irq+$softirq+$steal;
    $PrevTotal=$PrevIdle+$PrevNonIdle;
    $Total=$Idle+$NonIdle;

    $totald=$Total-$PrevTotal;
    $idled=$Idle-$PrevIdle;

    $CPU_Percentage=($totald-$idled)/$totald*100;

    $cpu=trim($cpu);
    $a_info[$cpu]=sprintf("%0.2f", $CPU_Percentage);
}

/* La primera linea "cpu" es el total, las otras son cada uno de los núcleos/cores físicos del microprocesador */

$s_output=isset($_SERVER["argv"][2])?$_SERVER["argv"][2]:"text";
if($s_output=="text"){
    foreach($a_info as $s_cpu => $s_cpu_percent){
        echo sprintf("$s_cpu %s%%\n", $s_cpu_percent);
    }
} else {
    echo json_encode($a_info);
}

exit(0);
