<!DOCTYPE html>
<?php
	$success="";
	if(isset($_POST['str1']))
	{
		$str1=$_POST['str1'];
		$str2=$_POST['str2'];
		if($str1=="")
		{
			$success="alert";
			$message="字符串1为空，请重新提交";
		}
		else if($str2=="")
		{
			$success="alert";
			$message="字符串2为空，请重新提交";
		}
		else
		{
			$success="alert alert-success";
			$byte=similar_text($str1,$str2,$percent);
			$percent=floor($percent);
			$message=$byte."    ".$percent;
		}
	}
?>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<script src="js_src/jquery.js"></script>
	<style>
		.hide {display:none;}
	</style>
	<script>
		$(document).ready(function(){
			$('.close').on('click',function(){
				$('.alert').addClass("hide");
			});	
			$('.quit').on('click',function(){
				window.opener=null;
				window.open('','_self');
				window.close();
			});
		});
	</script>
</head>
<body class="container-fluid">
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span6 offset3">
			<form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<br/><br/>
				<div class="control-group">
					<div class="controls" style="position:relative;left:-50px;">
						<h3>比较字符串相似程度</h3>
					</div>
				</div>
				<div class="control-group">
					 <label class="control-label" for="inputStr1">字符串一</label>
					<div class="controls">
						<input name="str1" id="inputStr1" type="text" placeholder="Please Input str1"/>
					</div>
				</div>
				<div class="control-group">
					 <label class="control-label" for="inputStr2">字符串二</label>
					<div class="controls">
						<input name="str2" id="inputStr2" type="text" placeholder="Please Input str2"/>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn">确认</button>
						<button type="reset" class="btn">重置</button>
						<button class="btn quit">退出页面</button>
						<?php if($success!="") { ?>
						<div class="<?php echo $success; ?>" style="position:relative;top:20px;left:-100px;">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<?php
								if($success=="alert") echo "<strong>Warning!</strong>. $message";
								else echo "字符串  ".$str1."  ".$str2."<br/>的匹配字符数和相似度分别为：<br/>".$message."%";
							?>
						</div>
						<?php } ?>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>