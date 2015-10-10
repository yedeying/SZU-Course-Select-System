<?php
	include("function.php");
	$head=array("CourseID","Cname","Class","TimeNum","Teacher","Point","Property","Remark");
	$headname=array("课程号","课程名称","主选班级","上课时间","主讲老师","学分","类别","备注");
	$propertyName=array("综合必修","文科必修","文科选修","理科必修","理科选修");
	$weekday=array("周一","周二","周三","周四","周五");
	$daytime=array("1,2","3,4","5,6","7,8","9,10","11,12");
	$allowlen=23;
	$showlen=18;
	$sql=$_POST['sql'];
	$txt=$_POST['txt'];
	$status=$_POST['status'];
	$con=mysql_connect("localhost","root","yedeying");
	mysql_query("set names 'utf8'");
	mysql_select_db("ye",$con);
	if($status=='false')
	{
		$result=mysql_query($sql);
		$result1=mysql_query($sql);
		if(!$row=mysql_fetch_array($result1)) echo "<h4 class='alert'>暂无课程</h4>";
		else include("makecoursetable.php");
	}
	else
	{
		$result=mysql_query($sql);
		$result1=mysql_query($sql);
		if(!$row=mysql_fetch_array($result1)) echo "<h4 class='alert'>暂无课程</h4>";
		else
		{
			echo "
			<table class='table table-striped table-bordered'>
			<tr>
			<th></th><th></th>";
			foreach($headname as $value) echo "<th>$value</th>";
			echo "</tr>";
			while($row=mysql_fetch_array($result))
			{
				$bbl=1;
				$s="";
				$bl=0;
				$s.="<tr>
				<td><input id='c".$row['CourseID']."' type='checkbox' /></td>";
				$s.="<td width='10px'><a href='#' style='text-decoration:none '><i class='icon-search icon-large' data-text='".$row['CourseID']."' data-placement='right' rel='tooltip' data-html='true' data-container='body' data-title='已选人数：<i class=\"icon-spinner icon-spin\"></i> &nbsp;可选人数：<i class=\"icon-spinner icon-spin\"></i>'</i></a></td>";
				foreach($head as $value)
				{
					if($value=='Property') $s.="<td>".$propertyName[$row[$value]]."</td>\n";
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
						if($num==0) $s.="<td>无</td>\n";
						else if(strlen($strr)>$allowlen) $s.="<td><abbr title='".$strr."'>".getstr($strr,$showlen)."..</td>\n";
						else $s.="<td>".$strr."</td>\n";
						if(!strstr($strr,$txt)) $bbl=0;
					}
					else if($row[$value]=="") $s.="<td>无</td>\n";
					else if(strlen($row[$value])>$allowlen) $s.="<td><abbr title='".$row[$value]."'>".getstr($row[$value],$showlen)."..</td>\n";
					else $s.="<td>".$row[$value]."</td>\n";
				}
				$s.="</tr>";
				if($bbl==1) echo $s;
			}
			echo "</table>";
		}
	}
?>