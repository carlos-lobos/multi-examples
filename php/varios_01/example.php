<?php

/**
 * Example for:
 *    + Principal Logic
 *    + Manage Uniques Global Objects for the proyect
 *    + Manage Connections to diferents DBs
 *    + Manage Data from authenticated user (using apache basic authentication)
 */

require_once "PrincipalLogic.php";

$oPL = new PrincipalLogic();
$aData=$oPL->GetData();
echo "".var_export($aData,true);
