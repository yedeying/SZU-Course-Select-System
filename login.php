<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/login_style.css" rel="stylesheet"/>
	</head>
	<body id="body">
		<div class="container-fluid inputBox">
			<span><h6 class="muted">Welcome to Course Choosing System</h6></span>
			<hr/ class="hr1">
			<span class="signInLogo"><h2 class="text-warning">Please Sign In</h2></span>
			<form id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<input name="stuno" id="stuno" type="text" class="stuno input-xlarge myText" placeholder="Your Student Number"/>
				<input name="pass" id="pass" type="password" class="input-xlarge myText" placeholder="Your Password"/>
				<div class="hidepass h1">
					<input name="npass" id="npass"type="password" class="input-xlarge myText" placeholder="Your New Password"/>
				</div>
				<div class="hidepass h2">
					<input name="cpass" id="cpass" type="password" class="input-xlarge myText" placeholder="Confirm Your Password"/>
				</div>
				<div class="hide"><input name="method" id="method" type="text" value="0"/></div>
			</form>
			<form action="index.php" name="form2" class="hide" method="POST">
				<input type="text" name="stuno"/>
				<input type="text" name="pass"/>
			</form>
			<form action="4.php" name="form3" class="hide" method="POST">
				<input type="text" name="stuno"/>
				<input type="text" name="pass"/>
			</form>
			<span><a href="forget.php" class="forget">忘记密码？</a></span><br/>
			<span class="buttonGroup">
				<button data-dissmiss="alert" class="btn button1">登录</button>
				<button id="a" class="btn button2">数据管理</button>
				<button class="btn button3">修改密码</button>
				<button class="btn button4" onclick="clo()">退出</button>
			</span>
			<div class="myalert alert" style="width:0%;height:20px;padding:8px 0px 8px 0px;border:0px">
				<h6 class="alerttext"></h6>
			</div>
		</div>
		<div class="bottom">
			<p>Design and built by <a href="http://weibo.com/yedeying/">@ye</a> & <a href="#">@yr</a>.</p>
			<p>Copyright @ 2013-2014 YYGO Team. All Rights Reserved.</p>
		</div>
		<script src="js_src/jquery.js"></script>
		<script src="js_src/bootstrap.min.js"></script>
		<script src="js_src/login_script.js"></script>
	</body>
</html>
	<?php
	if(isset($_POST['method']))
	{
		$method=$_POST['method'];
		$stuno=$_POST['stuno'];
		$pass=$_POST['pass'];
		$con = mysql_connect("localhost","root","yedeying");
		mysql_query("set names 'utf8'");
		if(!$con)
		{
			echo "<script>clear(2,\"连接失败\")</script>";
			exit;
		}
		mysql_select_db("ye",$con);
		$result = mysql_query("select * from student where stuno = ".$stuno." and password = '".sha1($pass)."'");
		if(!$result)
		{
			echo "<script>clear(2,\"用户名或密码错误，请重新输入\")</script>";
			exit;
		}
		if(!($row = mysql_fetch_array($result)))
		{
			echo "<script>clear(2,\"用户名或密码错误，请重新输入\");</script>";
			if($method==1) echo "<script>click();</script>";
			exit;
		}
		if($method==1)
		{
			$cpass=$_POST['cpass'];
			$query="update student SET password = '".sha1($cpass)."' where stuno = ".$stuno." and password = '".sha1($pass)."'";
			mysql_query($query);
			echo "<script>alertshow(1,\"密码修改成功\")</script>";
		}
		else if($method==0)
		{
			echo "<script>alertshow(1,\"登录成功，将转至选课界面\")</script>";
			?>
			<script>
				document.form2.stuno.value=<?php echo "$stuno"; ?>;
				document.form2.pass.value=<?php echo "$pass"; ?>;
				document.form2.submit();
			</script>
			<?php
		}
		else
		{
			echo "<script>alertshow(1,\"登录成功，将转至免听界面\")</script>";
			?>
			<script>
				document.form3.stuno.value=<?php echo "$stuno"; ?>;
				document.form3.pass.value=<?php echo "$pass"; ?>;
				document.form3.submit();
			</script>
			<?php
		}
		mysql_close($con);
	}
	?>