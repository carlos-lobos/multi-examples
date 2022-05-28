<?php
require_once "TimeKeeper.php";

$oTK=new TimeKeeper();
$oTK->InitTimeKeeper();
sleep(2);
$oTK->MarkTime('STEP 1');
sleep(1);
$oTK->MarkTime('STEP 2');
sleep(1);
$oTK->EndTimeKeeper('END', 'PRINT');
