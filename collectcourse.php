<?php
	$con=mysql_connect("localhost","root","yedeying");
	mysql_query("set names 'utf8'");
	mysql_select_db("ye",$con);
	$str=$_POST['str'];
	$stuno=$_POST['stuno'];
	foreach($str as $value)
	{
		$sql= "SELECT * FROM collect WHERE courseid = ".$value." and stuno = ".$stuno;
		$result=mysql_query($sql);
		if(!mysql_fetch_array($result))
		{
			$sql = "INSERT INTO collect (CourseID, Stuno) VALUES ( ".$value." , ".$stuno.")";
			mysql_query($sql);
		}
	}
	include("function.php");
	$head=array("CourseID","Cname","Class","TimeNum","Teacher","Point","Property","Remark");
	$headname=array("课程号","课程名称","主选班级","上课时间","主讲老师","学分","类别","备注");
	$propertyName=array("综合必修","文科必修","文科选修","理科必修","理科选修");
	$weekday=array("周一","周二","周三","周四","周五");
	$daytime=array("1,2","3,4","5,6","7,8","9,10","11,12");
	$sql="select a.* from course a,collect b where a.CourseID = b.CourseID and b.Stuno = ".$stuno." order by cast(a.courseid as char(20))";
	$result=mysql_query($sql);
	$result1=mysql_query($sql);
	$allowlen=23;
	$showlen=18;
	if(!$row=mysql_fetch_array($result1)) echo "<h4 class='alert'>暂无课程</h4>";
	else include("makecoursetable.php");
?>