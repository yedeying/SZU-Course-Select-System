function clo()
{
	window.opener=null;
	window.open('','_self');
	window.close();
}
var login=1;
var finish=1;
function clear(method,str)
{
	$('#stuno').val("");
	$('#pass').val("");
	$('#stuno').focus();
	alertshow(method,str);
}
function alertshow(method,txt)
{
	while(finish==0);
	finish=0;
	len=100.0 / 22 * txt.length + 5;
	if(method==1) $(".myalert").addClass("alert-success");
	else $(".myalert").addClass("alert-error");
	$(".myalert").animate({width:(len+"%")},{complete:function(){
		var t=setTimeout("alertclose(method)",1000);
		finish=1;
	}});
	$(".alerttext").text("  "+txt);
}
function alertclose(method)
{
	$('.alerttext').text("");
	$(".myalert").animate({width:'0%'},{complete:function(){
		if(method==1) $(".myalert").removeClass("alert-success");
		else $(".myalert").removeClass("alert-error");
	}});
}
function validate()
{
	var stuno=$('#stuno').val();
	var password=$('#pass').val();
	var newpassword=$('#npass').val();
	var confirmpassword=$('#cpass').val();
	if(stuno=="")
	{
		alertshow(2,"帐号不能为空");
		$('#stuno').focus();
	}
	else if(password=="")
	{
		alertshow(2,"密码不能为空");
		$('#pass').focus();
	}
	else
	{
		if(login%2==1)
		{
			$('#method').val("0");
			$('#form').submit();
		}
		else if(newpassword=="")
		{
			alertshow(2,"请输入新密码");
			$('#npass').focus();
		}
		else if(confirmpassword=="")
		{
			alertshow(2,"请再输入一遍");
			$('#cpass').focus();
		}
		else if(newpassword!=confirmpassword)
		{
			alertshow(2,"两次输入的密码不一致，请再次输入");
			$('#npass').val("");
			$('#cpass').val("");
			$('#npass').focus();
		}
		else
		{
			$('#method').val("1");
			$('#form').submit();
		}
	}
}
$(document).ready(function(){
	$('#stuno').focus();
	$('.button3').on('click',function(){
		click();
	});
	$('.button1').on('click',validate);
	$(document).keydown(function(e)
	{
		var key=e.which;
		if(key==13) validate();
	});
});
function click()
{
	$('.h1').slideToggle();
	$('.h2').slideToggle();
	if(login==1)
	{
		$('.button1').text('改密');
		$('.button2').addClass("disabled");
	}
	else
	{
		$('.button1').text('登录');
		$('.button2').removeClass("disabled");
	}
	$('#npass').val("");
	$('#cpass').val("");
	login=(login+1)%2;
}