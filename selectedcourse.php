
<?php
	$sql="SELECT * FROM student WHERE stuno = ".$stuno;
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	$sum=$row['Choosingx']+$row['Choosingy']+$row['Choosingz'];
	echo "<div class='alert alert-success'>已选学分:".$sum."&nbsp;&nbsp;&nbsp;&nbsp;限选学分:".$row['CanChoosePoint']."</div>";
	echo "<table class='table table-striped' style='font-size:12px;'>";
	echo "<tr>";
	$courseTitle=array("退课","课程号","课程名","类别","学分数","学分属性");
	foreach($courseTitle as $name) echo "<th>".$name."</th>"."\n";
	echo "</tr>";
	$col=array("courseid","cname","none","point","none");
	$type=array("公共必修","文科学分","理科学分");
	$atype=array("--","必修","选修");
	$sql = "select a.courseid,cname,property,point,freeornot from course a,selectedcourse b where a.courseid=b.courseid and stuno = ".$stuno." order by cast(a.courseid AS char(20))";
	$result = mysql_query($sql);
	$p=0;
	while($row = mysql_fetch_array($result))
	{
		$res[$p++]=$row;
		?>
		<tr>
			<td><input id="t<?php echo $row['courseid']; ?>" type="checkbox" /></td>
			<?php
			for($i=0;$i<5;$i++)
			{
				if($i==2) echo "<td>".$type[(int)(($row['property']+1)/2)]."</td>"."\n";
				else if($i==1)
				{
					echo "<td>".$row[$col[$i]];
					if($row['freeornot']==1) echo "<span class='label label-success'>免听</span>";
					else if($row['freeornot']==2) echo "<span class='label label-warning'>免听申请中</span>";
					echo "</td>"."\n";
				}
				else if($i==4)
				{
					if($row['property']==0) $tmp=0;
					else if($row['property']%2==1) $tmp=1;
					else $tmp=2;
					echo "<td>".$atype[$tmp]."</td>"."\n";
				}
				else echo "<td>".$row[$col[$i]]."</td>"."\n";
			}
		echo "</tr>";
	}
	echo "</table>";
?>