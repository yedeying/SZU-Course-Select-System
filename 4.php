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
$rst = mysql_query("select * from student where stuno = ".$stuno." and password = '".sha1($pass)."'");
$sql = "SELECT * FROM course";
$courseresult = mysql_query($sql);
$bl=0;
if($row = mysql_fetch_array($rst)) $bl=1;
if($bl==0) close();
$result[0] = mysql_query("select * from student");
$result[1] = mysql_query("select * from course");
$result[2] = mysql_query("select * from college");
$result[3] = mysql_query("select * from selectedcourse");
if(isset($_POST['tonextpage'])) $mm=$_POST['tonextpage'];
else $mm=1;
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css" media="screen" />
	<link rel="stylesheet" href="css/scojs.css" media="screen" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="js_src/jquery.js"></script>
	<script src="js_src/bootstrap.min.js"></script>
	<script src="js_src/sco.message.js"></script>
	<script src="js_src/ajax.js"></script>
</head>
<body>
	<div style="padding-top:20px;padding-left:20px;">
	<h2>深圳大学学生选课系统数据管理</h2>
	</div>
	<br/>
	<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="tabbable">
				<ul class="nav nav-tabs">
					<li <?php if($mm==1) echo "class=\"active\""; ?>><a href="#p1" data-toggle="tab">student表</a></li>
					<li <?php if($mm==2) echo "class=\"active\""; ?>><a href="#p2" data-toggle="tab">course表</a></li>
					<li <?php if($mm==3) echo "class=\"active\""; ?>><a href="#p3" data-toggle="tab">college表</a></li>
					<li <?php if($mm==4) echo "class=\"active\""; ?>><a href="#p4" data-toggle="tab">selectedcourse表</a></li>
				</ul>
				<div class="tab-content">
				<?php
				$typenum=4;
				$type=array("success","info","error","warning");
				for($i=0;$i<4;$i++)
				{
					$bl=-1;?>
					<div class="tab-pane <?php if($i+1==$mm) echo "active"; ?>" id="p<?php echo $i+1; ?>">
						<div class="row-fluid">
							<div class="span12">
								<a href="#mcadd<?php echo $i+1; ?>" role="button" class="btn add<?php echo $i+1; ?>" data-toggle="modal">添加项目</a>
								<a href="#mcmod<?php echo $i+1; ?>" role="button" class="btn add<?php echo $i+1; ?>" data-toggle="modal">修改项目</a>
								<a href="#mcdel<?php echo $i+1; ?>" role="button" class="btn add<?php echo $i+1; ?>" data-toggle="modal">删除项目</a>
								<div>&nbsp;</div>
								<table class="table table-striped table-bordered">
									<?php
									$in=1;
									while($row=mysql_fetch_array($result[$i]))
									{
										if($in)
										{
											?>
											<thead>
												<tr><?php 
												$bl1=0;
												foreach($row as $head => $value)
												{
													$bl1=($bl1+1)%2;
													if($bl1) continue;
													echo "<th>".$head."</th>\n";
												}
												?>
												</tr>
											</thead>
											<tbody>
											<?php
										}
										$in=0;
										$bl=($bl+1)%$typenum;
										$bl1=0;
										$bl2=1;
										?><tr class="<?php echo $type[$bl]; ?>"><?php
											foreach($row as $value)
											{
												$bl1=($bl1+1)%2;
												if($bl1) continue;
												?><td><?php echo $value; ?></td>
												<?php
											}
										?>
										</tr><?php
									}
									?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
	</div>
	<?php include("dfor4.php"); ?>
	<form id="nextpage" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<div class="hide"><input name="tonextpage" type="text" id="tonextpage"/></div>
	</form>
</body>
</html>