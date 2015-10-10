<?php
	include("function.php");
	$head=array("CourseID","Cname","Class","TimeNum","Teacher","Point","Property","Remark");
	$headname=array("课程号","课程名称","主选班级","上课时间","主讲老师","学分","类别","备注");
	$propertyName=array("综合必修","文科必修","文科选修","理科必修","理科选修");
	$weekday=array("周一","周二","周三","周四","周五");
	$daytime=array("1,2","3,4","5,6","7,8","9,10","11,12");
	$allowlen=23;
	$showlen=18;
	$sql = "SELECT a.*,collegeName FROM student a,college b WHERE stuno = ".$stuno." and a.collegeID = b.collegeID LIMIT 0, 30 ";
	$result=mysql_query($sql,$con);
	$stu=mysql_fetch_array($result);
	$mycollege=$stu['collegeName'];
	$mygrade=$stu['Grade'];
	$mymajor=$stu['Major'];
	$myclass=$stu['Class'];
	for($i=-4;$i<35;$i++)
	{
		if($i>0) $ask[$i]="select * from course where collegeID = $i order by cast(courseid as char(20))";
		else if($i==0) $ask[$i]="select * from course where class like '**' order by cast(courseid as char(20))";
		else if($i==-1) $ask[$i]="select a.* from course a,collect b where a.CourseID = b.CourseID and b.Stuno = ".$stuno." order by cast(a.courseid as char(20))";
		else if($i==-2) $ask[$i]="select a.* from course a, student b where b.collegeID = a.collegeID and a.property = b.property * 2 and b.Stuno = ".$stuno." order by cast(a.courseid as char(20))";
		else if($i==-3) $ask[$i]="select a.* from course a, student b where b.collegeID = a.collegeID and a.property = b.property * 2 - 1 and b.Stuno = ".$stuno." order by cast(a.courseid as char(20))";
		else $ask[$i]="select * from course where property = 0 order by cast(courseid as char(20))";
	}
	echo "<div class='table-group'>\n";
	for($i=-4;$i<35;$i++)
	{
		echo "<div class='hide hide".($i+4)."'>";
		if($i==-2||$i==-3||$i==-4)
		{
			$result=mysql_query($ask[$i]);
			echo "
			<table class='table table-striped table-bordered'>
			<tr>
			<th></th><th></th>";
			foreach($headname as $value) echo "<th>$value</th>";
			echo "</tr>";
			while($row=mysql_fetch_array($result))
			{
				$class=strtok($row['Class'],'/');
				$bl=0;
				while($class!==false)
				{
					if($class=='**'||$class==$mycollege.'**'||$class==$mygrade.'**'||$class==$mygrade.$mycollege.'**'||$class==$mygrade.$mymajor.'**'||strstr($class,$mygrade.$mymajor)||$class==$mygrade.$mymajor.$myclass) {$bl=1;break;}
					$class=strtok('/');
				}
				if($bl==0) continue;
				$bl=0;
				echo "<tr>
				<td><input id='c".$row['CourseID']."' type='checkbox' /></td>";
				echo "<td width='10px'><a href='#' style='text-decoration:none '><i class='icon-search icon-large' data-text='".$row['CourseID']."' data-placement='right' rel='tooltip' data-html='true' data-container='body' data-title='已选人数：<i class=\"icon-spinner icon-spin\"></i> &nbsp;可选人数：<i class=\"icon-spinner icon-spin\"></i>'</i></a></td>";
				foreach($head as $value)
				{
					if($value=='Property') echo "<td>".$propertyName[$row[$value]]."</td>\n";
					else if($value=='TimeNum')
					{
						$num=$row[$value];
						$strr="";
						for($j=1;$j<=$num;$j++)
						{
							$tmp=$row['Time'.$j];
							$str=$weekday[intval($tmp/100)-1].$daytime[intval($tmp/10)%10-1];
							if($tmp%10==1) $str="单".$str;
							else if($tmp%10==2) $str="双".$str;
							$str.="(".$row['Classroom'.$j].") ";
							$strr.=$str;
						}
						if($num==0) echo "<td>无</td>\n";
						else if(strlen($strr)>$allowlen) echo "<td><abbr title='".$strr."'>".getstr($strr,$showlen)."..</td>\n";
						else echo "<td>".$strr."</td>\n";
					}
					else if($row[$value]=="") echo "<td>无</td>\n";
					else if(strlen($row[$value])>$allowlen) echo "<td><abbr title='".$row[$value]."'>".getstr($row[$value],$showlen)."..</td>\n";
					else echo "<td>".$row[$value]."</td>\n";
				}
				echo "</tr>";
			}
			echo "</table>";
		}
		else
		{
			$result=mysql_query($ask[$i]);
			$result1=mysql_query($ask[$i]);
			if(!$row=mysql_fetch_array($result1)) echo "<h4 class='alert'>暂无课程</h4>";
			else include("makecoursetable.php");
		}
		echo "</div>";
	}
	echo "</div>";
?>