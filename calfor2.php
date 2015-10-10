<?php
	$a=$_GET["a"];
	$b=$_GET["b"];
	$c=$_GET["c"];
	if($a=="") echo "1A不能为空，请填写完整";
	else if($b=="") echo "1B不能为空，请填写完整";
	else if($c=="") echo "1C不能为空，请填写完整";
	else if(!is_numeric($a)) echo "3A不是数字或含有空格，请重新填写";
	else if(!is_numeric($b)) echo "3B不是数字或含有空格，请重新填写";
	else if(!is_numeric($c)) echo "3C不是数字或含有空格，请重新填写";
	else
	{
		$delta=$b*$b-4*$a*$c;
		if($delta<0) echo "2本方程无实根";
		else
		{
			$x1=(-1*$b+(sqrt($delta)))/(2.0*$a);
			$x2=(-1*$b-(sqrt($delta)))/(2.0*$a);
			if($delta==0) printf("2本方程有两相等实根，分别为x1=x2=%.2lf",$x1);
			else printf("2本方程有两不等实根，分别为x1=%.2lf x2=%.2lf",$x1,$x2);
		}
	}
?>