<!DOCTYPE html>
<html>
<?php include("yanzheng.php"); ?>
<head>
	<title>Welcome to Course Choosing System</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/index_style.css" rel="stylesheet"/>
	<link href="css/font-awesome.css" rel="stylesheet"/>
	<link rel="stylesheet" href="css/messenger.css" />
	<link rel="stylesheet" href="css/messenger-theme-future.css" />
	<link rel="stylesheet" href="css/bootstrapSwitch.css" />
	<style>
		.input-append
		{
			margin-top:10px;
		}
		select:focus
		{
			border-color: rgba(82, 168, 236, 0.8);
			outline: 0;
			outline: thin dotted \9;
			-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
			-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
				box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
		}
		select
		{
			margin-top:10px;
			width:95px;
			display: inline-block;
			padding: 4px 6px;
			margin-bottom: 10px;
			font-size: 14px;
			line-height: 20px;
			color: #555555;
			vertical-align: middle;
			-webkit-border-radius: 4px;
				 -moz-border-radius: 4px;
						border-radius: 4px;
			background-color: #ffffff;
			-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
				-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
					box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
			-webkit-transition: border linear 0.2s, box-shadow linear 0.2s;
				-moz-transition: border linear 0.2s, box-shadow linear 0.2s;
					-o-transition: border linear 0.2s, box-shadow linear 0.2s;
						transition: border linear 0.2s, box-shadow linear 0.2s;
		}
	</style>
</head>
<body>
	<?php include('makecourse.php'); ?>
	<div class="navbar navbar-inverse yenav navbar-fixed-top">
		<div class="navbar-inner">
			<a class="brand mybrand" href="http://www.szu.edu.cn">Shenzhen University</a>
			<ul class="nav">
				<li class="chartbtn"><a href=javascript:void(0) class="selectkechengbiao curriculum">课程表</a></li>
				<li class="choosedbtn"><a href=javascript:void(0) class="selected-curriculum">已选课程</a></li>
			</ul>
			<ul class="nav pull-right">
				<li><a href="login.php">退出系统</a></li>
			</ul>
		</div>
		<div class="control-bar">
		</div>
	</div>
	<script src="js_src/jquery.js"></script>
	<script src="js_src/bootstrap.min.js"></script>
	<script src="js_src/sco.collapse.js"></script>
	<script src="js_src/jquery.pin.js"></script>
	<script src="js_src/messenger.min.js"></script>
	<script src="js_src/index_script.js"></script>
	<script src="js_src/bootstrapSwitch.js"></script>
	<?php include("script.php"); ?>
	<?php include("kechengbiao.php"); ?>
	<div class="row-fluid" style="margin-top: 18px;">
		<div class="span2 main-left">
			<ul class="nav nav-list main-list">
				<li class="nav-header">常用</li>
				<li class="active"><a href="#" class="college-1">我的收藏</a></li>
				<li><a href=javascript:void(0) class="college-2">我的专业选修</a></li>
				<li><a href=javascript:void(0) class="college-3">我的专业必修</a></li>
				<li><a href=javascript:void(0) class="college-4">我的公共必修</a></li>
				<li><a href=javascript:void(0) class="college0">公选课程</a></li>
				<li class="divider"></li>
				<li class="nav-header">学院列表</li>
			<?php
				$sql = "SELECT * FROM college ORDER BY CollegeID";
				$result = mysql_query($sql);
				while($row=mysql_fetch_array($result))
				{
					echo "<li><a href=javascript:void(0) class=\"college".$row['CollegeID']."\">";
					echo $row['CollegeName'];
					echo "</a></li>\n";
				}
			?>
			</ul>
		</div>
		<div class="main-right">
			<div class="sidenav">
				<div class="row course_table">
					<div class="span12 main-right-inner" onscroll="hidetop();">
						<ul class="nav nav-list main-list">
						<li>
							<a href="#" data-parent=".sidenav" id="curriculum" class="ye" style="display:none">课程表</a>
							<div class="collapsible hide">
								<span class="label" style="margin-bottom: 10px;">课程表</span>
								<table class="table table-bordered course-table" style="font-size:12px;">
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
							<a href="#" data-parent=".sidenav" id="selected-curriculum" class="ye" style="display:none">已选课程</a>
							<div class="collapsible hide">
								<span class="label" style="margin-bottom: 10px;">已选课程</span>
								<div class="selectedcourse-table">
								<?php include("selectedcourse.php"); ?>
								</div>
							</div>
						</li>
						<li style="list-style: none;">
							<span class="label makecourselabel" style="margin-bottom: 10px;">课程列表</span>
							<div class="makecourse"></div>
						</li>
						</ul>
						<script>
							$('.makecourse').html($('.hide3').html());
							$('.icon-search').tooltip();
							$('.icon-search').hover(function(e)
							{
								var id=$(this).attr('data-text');
								var ths=$(this);
								var ajax=$.ajax(
								{
									type:"POST",
									url:"getNumber.php",
									data:{id:id}
								})
								.done(function(msg)
								{
									$('.tooltip-inner').html(msg);
								});
							});
						</script>
					</div>
					<div class="main-bottom">
						<div class="hide"></div>
						<button class="btn select-course btn-inverse">选课</button>
						<button class="btn quit-course btn-inverse">退课</button>
						<button class="btn freelistening-course btn-inverse">申请免听</button>
						<button class="btn collect btn-inverse hide">收藏课程</button>
						<button class="btn decollect btn-inverse">取消收藏</button>
						<button class="btn selectall btn-inverse">全选</button>
						<button class="btn selectinverse btn-inverse">反选</button>
						<select muliple="multiple">
							<option data-value="0">按课程名</option>
							<option data-value="1">按课程号</option>
							<option data-value="2">按上课时间及地点</option>
							<option data-value="3">按主讲老师</option>
							<option data-value="4">按主选班级</option>
						</select>
						<div class="input-append">
							<input class="search-text" placeholder="输入检索信息" type="text">
							<button class="btn go" type="button">GO!</button>
							<a href="#modal-container-search" role="button" class="btn btn-inverse" data-toggle="modal">多条件查询</a>
						</div>
						<button class="btn btn-inverse hide gototop"><i class="icon-home icon-arrow-up"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="modal-container-search" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">
				多条件查询
			</h3>
		</div>
		<div class="modal-body">
			<form class="form-horizontal" style="margin-left:50px;">
			<div class="control-group">
				<label class="control-label">
				 	按课程名
				 	<div class="switch switch-small switch1">
						<input type="checkbox" />
					</div>
				</label>
				<div class="controls">
					<input required disabled class="input1" type="text" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
				 	按课程号
				 	<div class="switch switch-small switch2">
						<input type="checkbox" />
					</div>
				</label>
				<div class="controls">
					<input disabled required class="input2" type="text" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
				 	按上课时间
				 	<div class="switch switch-small switch3">
						<input type="checkbox" />
					</div>
				</label>
				<div class="controls">
					<input disabled required class="input3" type="text" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
				 	按主讲老师
				 	<div class="switch switch-small switch4">
						<input type="checkbox" />
					</div>
				</label>
				<div class="controls">
					<input disabled required class="input4" type="text" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">
				 	按主选班级
				 	<div class="switch switch-small switch5">
						<input type="checkbox" />
					</div>
				</label>
				<div class="controls">
					<input disabled required class="input5" type="text" />
				</div>
			</div>
			</form>
		</div>
		<div class="modal-footer">
			<button class="btn close-search" data-dismiss="modal" aria-hidden="true">关闭</button>
			<button class="btn btn-primary multi-search">搜索</button>
		</div>
		<script>
		<?php
			for($i=1;$i<6;$i++){ ?>
			$('.switch<?php echo $i; ?>').on('switch-change',function(e,data)
			{
				var $el = $(data.el), value = data.value;
				if(value) $('.input<?php echo $i; ?>').removeAttr('disabled');
				else $('.input<?php echo $i; ?>').attr('disabled','');
			});
		<?php } ?>
		</script>
	</div>
</body>
</html>