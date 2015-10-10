<!DOCTYPE html>
<html>
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<?php
		date_default_timezone_set("Asia/Shanghai");
		$str1=time();
		$str2=strtotime('2012-07-28 03:12:00');
		$dis=$str1-$str2;
	?>
	<div class="container-fluid" style="position:relative;top:10%;">
		<div class="row-fluid">
			<div class="span12">
				<p class="text-center">
					<table align="center">
						<tr>
							<td>现在的时间为：</td>
							<td><button class="btn"><?php echo date("Y年m月d日 H:i<br>",time()); ?></button></td>
						</tr>
						<tr>
							<td>距伦敦奥运天数为：</td>
							<td><button class="btn"><?php echo floor($dis/86400)."天<br/>"; ?></button></td>
						</tr>
					</table>
				</p>
			</div>
		</div>
	</div>
</body>
</html>