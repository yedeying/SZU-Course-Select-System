<?php
	echo "
	<table class='table table-striped table-bordered'>
	<tr>
	<th></th><th></th>";
	foreach($headname as $value) echo "<th>$value</th>";
	echo "</tr>";
	while($row=mysql_fetch_array($result))
	{
		$bl=0;
		echo "<tr>
		<td><input id='c".$row['CourseID']."' type='checkbox' /></td>";
		echo "<td width='10px'><a href='#' style='text-decoration:none '><i class='icon-search icon-large' data-text='".$row['CourseID']."' data-placement='right' rel='tooltip' data-html='true' data-container='body' data-title='已选人数：<i class=\"icon-spinner icon-spin\"></i> &nbsp;可选人数：<i class=\"icon-spinner icon-spin\"></i>'</i></a></td>";
		foreach($head as $value)
		{
			if($value=='Property') echo "<td>".$propertyName[$row[$value]]."</td>\n";
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
				if($num==0) echo "<td>无</td>\n";
				else if(strlen($strr)>$allowlen) echo "<td><abbr title='".$strr."'>".getstr($strr,$showlen)."..</td>\n";
				else echo "<td>".$strr."</td>\n";
			}
			else if($row[$value]=="") echo "<td>无</td>\n";
			else if(strlen($row[$value])>$allowlen) echo "<td><abbr title='".$row[$value]."'>".getstr($row[$value],$showlen)."..</td>\n";
			else echo "<td>".$row[$value]."</td>\n";
		}
		echo "</tr>";
	}
	echo "</table>";
?>