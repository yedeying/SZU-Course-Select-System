<?php
	$con=mysql_connect("localhost","root","yedeying");
	mysql_query("set names 'utf8'");
	mysql_select_db("ye",$con);
	$str=$_POST['str'];
	$stuno=$_POST['stuno'];
	$status=$_POST['status'];
	foreach($str as $value)
	{
		$sql = "SELECT a.*,collegeName FROM student a,college b WHERE stuno = ".$stuno." and a.collegeID = b.collegeID LIMIT 0, 30 ";
		$result=mysql_query($sql,$con);
		$stu=mysql_fetch_array($result);
		$mycollege=$stu['collegeName'];
		$mygrade=$stu['Grade'];
		$mymajor=$stu['Major'];
		$myclass=$stu['Class'];
		$sql= "SELECT * FROM course WHERE courseid = ".$value;
		$result=mysql_query($sql,$con);
		$row=mysql_fetch_array($result);
		/* 判断是否为主选 */
		$class=strtok($row['Class'],'/');
		$bl=0;
		while($class!==false)
		{
			if($class=='**'||$class==$mycollege.'**'||$class==$mygrade.'**'||$class==$mygrade.$mycollege.'**'||$class==$mygrade.$mymajor.'**'||strstr($class,$mygrade.$mymajor)||$class==$mygrade.$mymajor.$myclass) {$bl=1;break;}
			$class=strtok('/');
		}
		$primary=$bl;
		/* 判断是否为主选 */
		/* 判断是否学分超限 */
		if($stu['Choosingx']+$stu['Choosingy']+$stu['Choosingz']+$row['Point']>$stu['CanChoosePoint'])
		{
			echo "0`你的学分已不足|";
			break;
		}
		/* 判断是否学分超限 */
		if($row['CollegeID']!='21'||$status!=1) /* 体育部特殊处理 */
		{

			/* 判断是否重复选择 */
			$sql = "SELECT * FROM selectedcourse WHERE courseid = ".$value." and stuno = ".$stuno;
			if(mysql_num_rows(mysql_query($sql,$con)))
			{
				echo "0`你已经选择了《".$row['Cname']."》这门课程|";
				break;
			}
			/* 判断是否重复选择 */
			/* 判断是否已选 */
			$sql = "SELECT a.* FROM selectedcourse a,course b WHERE a.courseid = b.courseid and Cname = '".$row['Cname']."' and a.stuno = ".$stuno;
			if(mysql_num_rows(mysql_query($sql,$con)))
			{
				echo "0`《".$row['Cname']."》与你已选择的课程冲突|";
				break;
			}
			/* 判断是否已选 */
			$propery=$row['Property'];
			$pointproperty=array('Choosingx','Choosingy','Choosingz');
			if($propery==0||$propery==1||$propery==3) $option=0;
			else if($row['CollegeID']==$stu['CollegeID']) $option=2;
			else $option=1;
			$sql = "INSERT INTO selectedcourse (CourseID, Stuno, FreeOrNot) VALUES ('".$value."', '".$stuno."', '2')";
			mysql_query($sql,$con);
			$sql = "UPDATE student SET ".$pointproperty[$option]." = ".$pointproperty[$option]." + ".$row['Point']." WHERE Stuno = ".$stuno;
			mysql_query($sql,$con);
			echo "1`《".$row['Cname']."》免听申请成功|";
		}
		else
		{
			echo "0`体育课不支持免听申请|";
			break;
		}
	}
	include("kechengbiao.php");
	?>
	<tr>
		<th style="width:55px;">课程</th>
		<th>周一</th>
		<th>周二</th>
		<th>周三</th>
		<th>周四</th>
		<th>周五</th>
	</tr>
	<?php
		for($i=0;$i<6;$i++)
		{
			echo "<tr>"."\n";
			echo "<td>".$HeadTime[$i]."</td>"."\n";
			for($j=0;$j<5;$j++)
			{
				$makeMethod=$courseTime[$i][$j];
				if($makeMethod==-1) echo "<td></td>"."\n";
				else if($makeMethod%10==0)
				echo "<td>".$courseName[$i][$j]."(".$coursePlace[$i][$j]." )</td>"."\n";
				else
				echo "<td>".$courseName[$i][$j]."(".$coursePlace[$i][$j]." )".$courseName1[$i][$j]."(".$coursePlace1[$i][$j]." )</td>"."\n";
			}
			echo "</tr>"."\n";
		}
	echo "|";
	include("selectedcourse.php");
?>