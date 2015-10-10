<?php
mysql_select_db("ye",$con);
$HeadTime=array("1,2节","3,4节","5,6节","7,8节","9,10节","11,12节");
$result=mysql_query("select cname,freeornot, timenum,time1,classroom1,time2,classroom2,time3,classroom3,time4,classroom4,time5,classroom5 from selectedcourse a,course b where a.CourseID=b.CourseID and a.stuno=".$stuno);
for($i=0;$i<6;$i++) for($j=0;$j<5;$j++)
{
	$courseTime1[$i][$j]=$courseTime[$i][$j]=-1;
	$coursePlace1[$i][$j]=$coursePlace[$i][$j]="";
}
while($row = mysql_fetch_array($result))
{
	for($k=1;$k<=5;$k++)
	{
		if($row['timenum']>=$k)
		{
			$ii=floor($row['time'.$k]/10)%10-1;
			$jj=floor($row['time'.$k]/100)-1;
			$courseTime[$ii][$jj]=0;
			if($coursePlace[$ii][$jj]!=""&&$courseName[$ii][$jj]!=$row['cname']) $courseTime[$ii][$jj]=1;
			if($courseTime[$ii][$jj]==0) $courseName[$ii][$jj]=$row['cname'];
			else $courseName1[$ii][$jj]=$row['cname'];
			$index=array(" "," 单 "," 双 ");
			if($courseTime[$ii][$jj]==0) $coursePlace[$ii][$jj].=$index[$row['time'.$k]%10].$row['classroom'.$k];
			else $coursePlace1[$ii][$jj].=$index[$row['time'.$k]%10].$row['classroom'.$k];
		}
	}
}
?>