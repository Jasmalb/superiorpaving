<?php
$server = 'SPC-DB\MSSQLServer';
$connectionInfo = array( "Database"=>"BrewPoint", "UID"=>"Web2dx", "PWD"=>"Web@dx$1");
$db = sqlsrv_connect( $server, $connectionInfo);




?>