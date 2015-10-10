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
///to change the status of course choosing system
$coursestatus=1;
?>
<script>
	var stuno=<?php echo $stuno; ?>;
	var coursestatus=<?php echo $coursestatus; ?>;
</script>