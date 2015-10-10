<?php
	$q=$_GET["q"];
	$p=$_GET["p"];
	$con = mysql_connect("localhost","root","yedeying");
	mysql_query("set names 'utf8'");
	if(!$con) close();
	mysql_select_db("ye",$con);
	if($result=mysql_query($p)) echo "1";
	else echo "0";
?>