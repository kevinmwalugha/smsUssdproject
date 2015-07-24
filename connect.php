<?php
// ini_set('display_startup_errors',1);
// ini_set('display_errors',1);
// error_reporting(-1);

$hostname = "localhost";
$username = "dynamicc_Admin";//root
$password = "dynamiccadmin2015";//""
$connection =  @mysql_connect($hostname, $username, $password) or
 trigger_error(mysql_error(),E_USER_ERROR);

mysql_select_db("dynamicc_Student");

?>
