<!DOCTYPE html>
<html>
<?php
	function close()
	{
		?>
		<script>
			window.location.href='login.php';
		</script>
		<?php
		exit;
	}
	if(!isset($_POST['stuno'])) close();
	$stuno=$_POST['stuno'];
	$pass=$_POST['pass'];
	$con = mysql_connect("localhost","root","yedeying");
	mysql_query("set names 'utf8'");
	if(!$con) close();
	mysql_select_db("ye",$con);
	$result = mysql_query("select * from student where stuno = ".$stuno." and password = '".sha1($pass)."'");
	$sql = "SELECT * FROM course";
	$courseresult = mysql_query($sql);
	$bl=0;
	if($row = mysql_fetch_array($result)) $bl=1;
	if($bl==0) close();
?>
<head>
	<title>Welcome to Course Choosing System</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/index_style.css" rel="stylesheet"/>
</head>
<body id="body">
	<?php
		$head=array("CourseID","Cname","Class","Teacher","Point","Remark");
		$headname=array("课程号","课程名称","主选班级","主讲老师","学分","备注");
		for($i=-1;$i<35;$i++)
		{
			if($i>0) $ask[$i]="select * from course where collegeID = $i ";
			else if($i==0) $ask[$i]="select * from course where class like '**' ";
			else $ask[$i]="select * from course a, student b where b.collegeID = a.collegeID and a.property = b.property * 2";
		}
		for($i=-1;$i<35;$i++)
		{
			echo "<div class='hide hide".($i+1)."'>";
			$result=mysql_query($ask[$i]);
			echo "
			<table class='table table-bordered border-striped'>
			<tr>
			<th></th>";
			foreach($headname as $value) echo "<th>$value</th>";
			echo "</tr>";
			while($row=mysql_fetch_array($result))
			{
				echo "<tr>
				<td><input id='c".$row['CourseID']."' type='checkbox' /></td>";
				foreach($head as $value)
				{
					echo "<td>".$row[$value]."</td>\n";
				}
				echo "</tr>";
			}
			echo "</table>";
			echo "</div>";
		}
	?>
	<div class="navbar navbar-inverse">
	<div class="navbar-inner">
		<a class="brand" href="http://www.szu.edu.cn">Shenzhen University</a>
		<ul class="nav">
			<li class="courselist"><a href="#">课程列表</a></li>
			<li class="chartbtn"><a href="#" class="selectkechengbiao ye1">课程表</a></li>
			<li class="choosedbtn"><a href="#" class="ye2">已选课程</a></li>
		</ul>
		<ul class="nav pull-right">
			<li><a href="login.php">退出系统</a></li>
		</ul>
	</div>
	</div>
	<script src="js_src/jquery.js"></script>
	<script src="js_src/bootstrap.min.js"></script>
	<script src="js_src/sco.collapse.js"></script>
	<script src="js_src/index_script.js"></script>
	<script>
	<?php
		for($i=-1;$i<35;$i++){ ?>
		$(document).on('click','.college<?php echo $i; ?>',function(){
			$('.makecourse').html($('.hide<?php echo $i+1; ?>').html());
			$('.ye-nav-list>.active').removeClass("active");
			$('.college<?php echo $i; ?>').parent().addClass("active");
		});
		<?php } ?>
	</script>
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
					$ii=($row['time'.$k]/10)%10-1;
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
		$db=@ new mysqli('localhost','root','yedeying','ye');
		if(mysqli_connect_errno()) close();
		$query=""
	?>
	<div class="row-fluid" style="margin-top: -20px;">
		<div class="span2 main">
			<ul class="nav nav-list ye-nav-list">
				<li class="nav-header">学院列表</li>
				<li class="active"><a href="#我的收藏" class="college-1">我的收藏</a></li>
				<li><a href="#公选课程" class="college0">公选课程</a></li>
			<?php
				$sql = "SELECT * FROM college ORDER BY CollegeID";
				$result = mysql_query($sql);
				while($row=mysql_fetch_array($result))
				{
					echo "<li><a href=\"#".$row['CollegeName']."\" class=\"college".$row['CollegeID']."\">";
					echo $row['CollegeName'];
					echo "</a></li>\n";
				}
			?>
			</ul>
		</div>
		<div class="span10 left">
		<div class="sidenav">
			<div class="row course_table">
				<div class="span12 main1">
					<ul class="nav nav-list">
					<li>
						<a href="#" data-parent=".sidenav" id="ye1" class="ye" style="display:none">课程表</a>
						<div class="collapsible hide">
							<span class="label" style="margin-bottom: 10px;">课程表</span>
							<table class="table table-bordered" style="font-size:12px;">
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
								?>
							</table>
						</div>
					</li>
					<li>
						<a href="#" data-parent=".sidenav" id="ye2" class="ye" style="display:none">已选课程</a>
						<div class="collapsible hide">
							<span class="label" style="margin-bottom: 10px;">已选课程</span>
							<table class="table table-striped" style="font-size:12px;">
							<tr>
							<?php
								$courseTitle=array("课程号","课程名","类别","学分数","学分属性","退课");
								foreach($courseTitle as $name) echo "<th>".$name."</th>"."\n";
							?>
							</tr>
							<?php
							$col=array("courseid","cname","none","point","none");
							$type=array("公共必修","文科学分","理科学分");
							$atype=array("--","必修","选修");
							$sql = "select a.courseid,cname,property,point from course a,selectedcourse b where a.courseid=b.courseid and stuno = ".$stuno." order by cast(a.courseid AS char(20))";
							$result = mysql_query($sql);
							$p=0;
							while($row = mysql_fetch_array($result))
							{
								$res[$p++]=$row;
								?>
								<tr>
									<?php
									for($i=0;$i<5;$i++)
									{
										if($i==2) echo "<td>".$type[(int)(($row['property']+1)/2)]."</td>"."\n";
										else if($i==4)
										{
											if($row['property']==0) $tmp=0;
											else if($row['property']%2==1) $tmp=1;
											else $tmp=2;
											echo "<td>".$atype[$tmp]."</td>"."\n";
										}
										else echo "<td>".$row[$col[$i]]."</td>"."\n";
									}
									?>
									<td><input id="c<?php echo $p; ?>" type="checkbox" /></td>
								</tr>
								<?php
								;
							}
							?>
							</table>
							<button class="btn btn-primary erasecourse">退课</button>
						</div>
					</li>
					<li style="list-style: none;">
						<span class="label makecourselabel" style="margin-bottom: 10px;">课程列表</span>
						<div class="makecourse"></div>
					</li>
					</ul>
					<script>$('.makecourse').html($('.hide0').html());</script>
				</div>
			</div>
		</div>
		</div>
	</div>
	<br/>
	<div class="bottom">
		<p>Design and built by <a href="http://weibo.com/yedeying/">@ye</a> & <a href="#">@yr</a>.</p>
		<p>Copyright @ 2013-2014 YYGO Team. All Rights Reserved.</p>
	</div>
</body>
</html>