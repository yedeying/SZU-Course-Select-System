<?php
	$name=array("student","course","college","selectedcourse");
	$hd[0]=array("Stuno","Password","Name","Grade","Major","Class","PENum","CollegeID","Property","Choosingx","Choosingy","Choosingz","CanChoosePoint");
	$hd[1]=array("CourseID","Property","Cname","Class","Teacher","Point","ChooseNumber","Choosed","FChooseNumber","FChoosed","WeeklyTime","Remark","CollegeID","TimeNum","Time1","Classroom1","Time2","Classroom2","Time3","Classroom3","Time4","Classroom4","Time5","Classroom5","Time6","Classroom6");
	$hd[2]=array("CollegeID","CollegeName","Pointx","Pointy","Pointz");
	$hd[3]=array("CourseID","Stuno","FreeOrNot");
	for($i=0;$i<4;$i++)
	{
?>
<script>
	var page=0;
	var mode=0;
	var typemode=new Array("添加","修改","删除");
	function yeAjax(str)
	{
		if(str==0) $.scojs_message(typemode[mode]+'失败', $.scojs_message.TYPE_ERROR);
		else
		{
			$.scojs_message(typemode[mode]+'成功，页面刷新中', $.scojs_message.TYPE_OK);
			if(page==1) $('#tonextpage').val("1");
			if(page==2) $('#tonextpage').val("2");
			if(page==3) $('#tonextpage').val("3");
			if(page==4) $('#tonextpage').val("4");
			$('#nextpage').submit();
		}
	}
</script>
<div id="mcadd<?php echo $i+1; ?>" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">
			添加<?php echo $name[$i]; ?>项目
		</h3>
	</div>
	<div class="modal-body">
		<div class="containter-fluid">
			<form class="form-horizontal">
			<div class="alert alert-info"><h4>请输入项目信息(按主键添加)</h4></div>
			<?php foreach($hd[$i] as $value) { ?>
			<div class="control-group">
				<label class="control-label" for="inputEmail"><?php echo $value; ?></label>
				<div class="controls">
					<input name="<?php echo "add".$value.$i; ?>" id="<?php echo "add".$value.$i; ?>" type="text" />
				</div>
			</div> <?php } ?>
			</form>
		</div>
	</div>
	<div class="modal-footer">
		 <button class="btn" data-dismiss="modal" aria-hidden="true">退出</button> <button class="btn btn-primary enteradd<?php echo $i+1;?>">确认添加</button>
	</div>
</div>
<script>
	$(document).ready(function(){
		$(".enteradd<?php echo $i+1; ?>").on("click",function(){
			page=<?php echo $i+1; ?>;
			mode=0;
			var str="addItem.php?q=<?php echo $i; ?>&p=";
			var sql = <?php echo "\""; ?> INSERT INTO <?php
			echo $name[$i];
			$bl=1;
			foreach($hd[$i] as $value)
			{
				echo ($bl?" ( ":" , ").$value;
				$bl=0;
			}
			echo ") VALUES ";
			$bl=1;
			foreach($hd[$i] as $value)
			{
				echo ($bl?" (\'\" + ":" + \"'\,\'\" + ")."$('#"."add".$value.($i)."').val()";
				$bl=0;
			}
			echo " + \"\')\";\n";
			?>
			str=str+sql;
			myAjax(str);
		});
	});
</script>
<?php }
	for($i=0;$i<4;$i++){ ?>
<div id="mcmod<?php echo $i+1; ?>" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">
			修改<?php echo $name[$i]; ?>项目
		</h3>
	</div>
	<div class="modal-body">
		<div class="containter-fluid">
			<form class="form-horizontal">
			<div class="alert alert-warning"><h4>请输入项目更改后信息(按主键查找)</h4></div>
			<?php foreach($hd[$i] as $value) { ?>
			<div class="control-group">
				<label class="control-label" for="inputEmail"><?php echo $value; ?></label>
				<div class="controls">
					<input name="<?php echo "mod".$value.$i; ?>" id="<?php echo "mod".$value.$i; ?>" type="text" />
				</div>
			</div> <?php } ?>
			</form>
		</div>
	</div>
	<div class="modal-footer">
		 <button class="btn" data-dismiss="modal" aria-hidden="true">退出</button> <button class="btn btn-primary entermod<?php echo $i+1;?>">确认修改</button>
	</div>
</div>
<script>
	$(document).ready(function(){
		$(".entermod<?php echo $i+1; ?>").on("click",function(){
			page=<?php echo $i+1; ?>;
			mode=1;
			var str="addItem.php?q=<?php echo $i; ?>&p=";
			var sql = <?php echo "\""; ?> UPDATE <?php
			echo $name[$i]." SET \"";
			$bl=1;
			foreach($hd[$i] as $value)
			{
				if($bl) echo " + \"".$value." = \'\" + "."$('#"."mod".$value.($i)."').val()"." + \"\' \"";
				else echo " + \" , ".$value." = \'\" + "."$('#"."mod".$value.($i)."').val()"." + \"\' \"";
				$bl=0;
			}
			echo " + \" WHERE ".$hd[$i][0]." = \'\" + "."$('#"."mod".$hd[$i][0].($i)."').val()"." + \"\' \" ;\n";
			?>
			str=str+sql;
			myAjax(str);
		});
	});
</script>
<?php }
	for($i=0;$i<4;$i++){ ?>
<div id="mcdel<?php echo $i+1; ?>" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">
			删除<?php echo $name[$i]; ?>项目
		</h3>
	</div>
	<div class="modal-body">
		<div class="containter-fluid">
			<form class="form-horizontal">
			<div class="control-group">
				<div class="alert alert-danger"><h4>请输入项目主键以删除</h4></div>
				<label class="control-label" for="inputEmail"><?php echo $hd[$i][0]; ?></label>
				<div class="controls">
					<input name="<?php echo "del".$hd[$i][0].$i; ?>" id="<?php echo "del".$hd[$i][0].$i; ?>" type="text" />
				</div>
			</div>
			</form>
		</div>
	</div>
	<div class="modal-footer">
		 <button class="btn" data-dismiss="modal" aria-hidden="true">退出</button> <button class="btn btn-primary enterdel<?php echo $i+1;?>">确认删除</button>
	</div>
</div> 
<script>
	$(document).ready(function(){
		$(".enterdel<?php echo $i+1; ?>").on("click",function(){
			page=<?php echo $i+1; ?>;
			mode=2;
			var str="addItem.php?q=<?php echo $i; ?>&p=";
			var sql = "DELETE FROM <?php echo $name[$i]; ?> WHERE <?php echo $hd[$i][0];?> = \'" + $('#del<?php echo $hd[$i][0].$i;?>').val() + "\'";
			str=str+sql;
			myAjax(str);
		});
	});
</script>
<?php } ?>