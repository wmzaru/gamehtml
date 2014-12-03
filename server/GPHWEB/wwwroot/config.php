<?php
$server="localhost";
$username="root";
$password="77999444";
$database="dnweb";
$conn=mysql_connect($server,$username,$password) or die ("could net connect mysql");
mysql_select_db($database,$conn) or die("could not open database");
mysql_query("SET @@character_set_connection=utf8,@@character_set_results=utf8,@@character_set_client=utf8");
?>