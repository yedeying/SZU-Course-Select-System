<?php
	$id=$_POST['id'];
	$con = mysql_connect("localhost","root","yedeying");
	mysql_query("set names 'utf8'");
	mysql_select_db("ye",$con);
	$sql = "SELECT * FROM course where CourseID = ".$id;
	$result = mysql_query($sql);
	if($row=mysql_fetch_array($result))
	{
		$a=$row['Choosed'];
		$b=$row['ChooseNumber'];
		echo "已选人数：".$a." 可选人数：".$b;
	}
	else die(mysql_error());
?>