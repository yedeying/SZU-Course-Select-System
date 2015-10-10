<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<script src="js_src/jquery.js"></script>
	<script src="js_src/ajax.js"></script>
	<style>
		.hide {display:none;}
	</style>
</head>
<body class="container-fluid">
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span5 offset3">
			<div class="form-horizontal">
				<br/><br/>
				<div class="control-group">
					<div class="controls" style="position:relative;left:-50px;">
						<h3>PHP计算一元二次方程的解</h3>
						<h5 class="alert alert-info">请输入一元二次方程ax^2+bx+c=0的三个参数</h5>
					</div>
				</div>
				<div class="control-group">
					 <label class="control-label" for="inputA">参数A</label>
					<div class="controls">
						<input name="a" id="inputA" type="text" placeholder="Please Input Variable A"/>
					</div>
				</div>
				<div class="control-group">
					 <label class="control-label" for="inputB">参数B</label>
					<div class="controls">
						<input name="b" id="inputB" type="text" placeholder="Please Input Variable B"/>
					</div>
				</div>
				<div class="control-group">
					 <label class="control-label" for="inputC">参数C</label>
					<div class="controls">
						<input name="C" id="inputC" type="text" placeholder="Please Input Variable C"/>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="hide"></button>
						<button class="btn cal">计算</button>
						<button class="btn reset">重置</button>
						<button class="btn quit">退出页面</button>
						<script>
							$(document).ready(function(){
								$('.close').on('click',function(){
									$('.ye').addClass("hide");
								});	
								$('.reset').on('click',function(){
									$('#inputA').val("");
									$('#inputB').val("");
									$('#inputC').val("");
									$('.ye').addClass("hide");
								})
								$('.quit').on('click',function(){
									window.opener=null;
									window.open('','_self');
									window.close();
								});
								$('.cal').on('click',function(){
									var str="calfor2.php?a="+$('#inputA').val()+"&b="+$('#inputB').val()+"&c="+$('#inputC').val();
									myAjax(str);
								})
							});
							function yeAjax(str)
							{
								var m=str[0];
								str=str.substr(1);
								$('.ye').removeClass("hide");
								$('.ye').removeClass("alert-success");
								$('.ye').removeClass("alert-warning");
								$('.ye').removeClass("alert-error");
								if(m=='1') $('.ye').addClass("alert-warning");
								if(m=='2') $('.ye').addClass("alert-success");
								if(m=='3') $('.ye').addClass("alert-error");
								$('.ye>span').text(str);
							}
						</script>
						<div class="alert hide ye" style="position:relative;top:20px;left:-60px;">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<span>a</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>