var isdown1=0;
var isdown2=0;
$(document).ready(function()
{
	$._messengerDefaults = {
		extraClasses: 'messenger-fixed messenger-theme-future messenger-on-bottom messenger-on-right'
	}
});
$(document).on('click', '.ye', function(e) 
{	$(this).scojs_collapse();
	return false;
});
$(document).on('click','.curriculum',function(e){
	isdown1=(isdown1+1)%2;
	$('#curriculum').scojs_collapse();
	if(isdown1==1) $(".chartbtn").addClass("active");
	else $(".chartbtn").removeClass("active");
	if($('.main-right-inner').scrollTop()!=0&&isdown1==1) $('.main-right-inner').animate({scrollTop:0}, 'slow'); 
	return false;
});
$(document).on('click','.selected-curriculum',function(e){
	isdown2=(isdown2+1)%2;
	$('#selected-curriculum').scojs_collapse();
	if(isdown2==1) $(".choosedbtn").addClass("active");
	else $(".choosedbtn").removeClass("active");
	if(isdown2==1)
	{
		if($('.main-right-inner').scrollTop()!=0) 
		if(isdown1==1&&$('.main-right-inner').scrollTop()!=410) $('.main-right-inner').animate({scrollTop:410}, 'slow');
		else if($('.main-right-inner').scrollTop()!=0) $('.main-right-inner').animate({scrollTop:0}, 'slow'); 
	}
	return false;
});
$(document).on('click','.collect',function(e)
{
	var check=$('.makecourse input[type=checkbox]:checked');
	var str=new Array;
	var i=0;
	$(check).each(function()
	{
		str[i]=$(this).attr('id').substr(1);
		i++;
	});
	if(i==0)
	{
		$.globalMessenger().post({
			message: "未选中任何课程",
			hideAfter: 2,
			type: 'error'
		});
		return;
	}
	else if(i>30)
	{
		$.globalMessenger().post({
			message: "一次最多可选择30个课程",
			hideAfter: 2,
			type: 'error'
		});
		return;
	}
	$.ajax({
		type:"POST",
		url:"collectcourse.php",
		data:{str:str,stuno:stuno}
	}).done(function(msg)
	{
		$.globalMessenger().post({
			message: "收藏成功",
			hideAfter: 2,
		});
		$('.hide3').html(msg);
		$('.makecourse input[type=checkbox]:checked').removeAttr('checked');
	});
});
$(document).on('click','.decollect',function(e)
{
	var check=$('.makecourse input[type=checkbox]:checked');
	var str=new Array;
	var i=0;
	$(check).each(function()
	{
		str[i]=$(this).attr('id').substr(1);
		i++;
	});
	if(i==0)
	{
		$.globalMessenger().post({
			message: "未选中任何课程",
			hideAfter: 2,
			type: 'error'
		});
		return;
	}
	else if(i>30)
	{
		$.globalMessenger().post({
			message: "一次最多可选择30个课程",
			hideAfter: 2,
			type: 'error'
		});
		return;
	}
	$.ajax({
		type:"POST",
		url:"decollectcourse.php",
		data:{str:str,stuno:stuno}
	}).done(function(msg)
	{
		$.globalMessenger().post({
			message: "取消收藏成功",
			hideAfter: 2,
		});
		$('.tooltip').addClass('important-hide');
		$('.hide3').html(msg);
		$('.makecourse').html(msg);
		inittooltip();
	});
});
function inittooltip()
{
	$('.icon-search').tooltip();
	$('.icon-search').hover(function(e)
	{
		var id=$(this).attr('data-text');
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
}
$(document).on('click','.selectall',function(e)
{
	$('.makecourse input').attr('checked','checked');
});
$(document).on('click','.selectinverse',function(e)
{
	$('.makecourse input').each(function()
	{
		if($(this).attr('checked')=='checked') $(this).removeAttr('checked');
		else $(this).attr('checked','checked');
	});
});
$(document).on('click','.go',function(e)
{
	var option=$('select>option:selected').attr("data-value");
	var data=$('.search-text').val();
	$('.main-list .active').removeClass('active');
	$('.collect').removeClass('hide');
	$('.decollect').addClass('hide');
	$.ajax({
		type:"POST",
		url:"searchcourse.php",
		data:{option:option,data:data}
	})
	.done(function(msg){
		$('.makecourse').html(msg);
		inittooltip();
	})
});
$(document).on('click','.select-course',function(e){
	var check=$('.makecourse input[type=checkbox]:checked');
	var str=new Array;
	var i=0;
	$(check).each(function()
	{
		str[i]=$(this).attr('id').substr(1);
		i++;
	});
	if(i==0)
	{
		$.globalMessenger().post({
			message: "未选中任何课程",
			hideAfter: 2,
			type: 'error'
		});
		return;
	}
	else if(coursestatus==0)
	{
		$.globalMessenger().post({
			message: "目前非选课阶段，无法选课",
			hideAfter: 2,
			type: 'error'
		});
		return;
	}
	$.ajax({
		type: "POST",
		url: "choosingcourse.php",
		data: {stuno:stuno,str:str,status:coursestatus}
	})
	.done(function(msg)
	{
		var words=msg.split('|'),i=0;
		for(i=0;i<words.length-2;i++)
		{
			$.globalMessenger().post({
				message: words[i].substr(2),
				hideAfter: 4,
				type: (words[i][0]=='0'?'error':'success')
			});
		}
		$('.course-table').html(words[i++]);
		$('.selectedcourse-table').html(words[i++]);
		$('.makecourse input[type=checkbox]:checked').removeAttr('checked');
	});
});
$(document).on('click','.quit-course',function(e){
	var check=$('.selectedcourse-table input[type=checkbox]:checked');
	var str=new Array;
	var i=0;
	$(check).each(function()
	{
		str[i]=$(this).attr('id').substr(1);
		i++;
	});
	if(i==0)
	{
		$.globalMessenger().post({
			message: "未选中任何课程",
			hideAfter: 2,
			type: 'error'
		});
		return;
	}
	else if(coursestatus==0)
	{
		$.globalMessenger().post({
			message: "目前非选课阶段，无法退课",
			hideAfter: 2,
			type: 'error'
		});
		return;
	}
	$.ajax({
		type: "POST",
		url: "quitingcourse.php",
		data: {stuno:stuno,str:str,status:coursestatus}
	})
	.done(function(msg)
	{
		var words=msg.split('|'),i=0;
		for(i=0;i<words.length-2;i++)
		{
			$.globalMessenger().post({
				message: words[i].substr(2),
				hideAfter: 4,
				type: (words[i][0]=='0'?'error':'success')
			});
		}
		$('.course-table').html(words[i++]);
		$('.selectedcourse-table').html(words[i++]);
	});
});
$(document).on('click','.freelistening-course',function(e){
	var check=$('.makecourse input[type=checkbox]:checked');
	var str=new Array;
	var i=0;
	$(check).each(function()
	{
		str[i]=$(this).attr('id').substr(1);
		i++;
	});
	if(i==0)
	{
		$.globalMessenger().post({
			message: "未选中任何课程",
			hideAfter: 2,
			type: 'error'
		});
		return;
	}
	else if(coursestatus!=2)
	{
		$.globalMessenger().post({
			message: "目前非免听申请阶段，无法申请免听",
			hideAfter: 2,
			type: 'error'
		});
		return;
	}
	$.ajax({
		type: "POST",
		url: "freelisteningcourse.php",
		data: {stuno:stuno,str:str,status:coursestatus}
	})
	.done(function(msg)
	{
		var words=msg.split('|'),i=0;
		for(i=0;i<words.length-2;i++)
		{
			$.globalMessenger().post({
				message: words[i].substr(2),
				hideAfter: 4,
				type: (words[i][0]=='0'?'error':'success')
			});
		}
		$('.course-table').html(words[i++]);
		$('.selectedcourse-table').html(words[i++]);
	});
});
$(document).on('click','.gototop',function(e){
	$('.main-right-inner').animate({scrollTop:0}, 'slow'); 
});
$(document).on('keypress','.search-text',function(e){
	if(e.which == 13)
	{
		$('.go').click();
	}
});
$(document).on('click','.multi-search',function(e,data)
{
	var ch=new Array(),txt=new Array();
	var sql = "select * from course where ";
	var ask=new Array("cname","courseid","","teacher","class");
	var bl=true;
	for(var i=1;i<=5;i++)
	{
		ch[i-1]=$('.switch'+i).bootstrapSwitch('status');
		txt[i-1]=$('.input'+i).val();
		if(ch[i-1]&&txt[i-1]=="")
		{
			$.globalMessenger().post({
				message: '输入项不能为空',
				hideAfter: 2,
				type: 'error'
			});
			$('.input'+i).focus();
			return;
		}
		else if(ch[i-1])
		{
			if(i!=3)
			{
				if(bl) sql=sql+ask[i-1]+" like \'%"+txt[i-1]+"%\' ";
				else sql=sql+" and "+ask[i-1]+" like \'%"+txt[i-1]+"%\' ";
				bl=false;
			}
		}
	}
	if(bl) sql=sql+" 1";
		$.ajax({
		type: "POST",
		url: "multisearch.php",
		data: {sql:sql,status:ch[2],txt:txt[2]}
	})
	.done(function(msg)
	{
		$('.makecourse').html(msg);
		inittooltip();
		$('.close-search').click();
	});
});
function hidetop()
{
	if($('.main-right-inner').scrollTop()==0) $('.gototop').fadeOut(500);
	else $('.gototop').fadeIn(500);
}