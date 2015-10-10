<script>
	<?php
	for($i=-4;$i<35;$i++){ ?>
	$(document).on('click','.college<?php echo $i; ?>',function(){
		$('.makecourse').html($('.hide<?php echo $i+4; ?>').html());
		$('.main-list>.active').removeClass("active");
		$('.college<?php echo $i; ?>').parent().addClass("active");
		if($('.main-right-inner').scrollTop()!=0) $('.main-right-inner').animate({scrollTop:0}, 'slow'); 
		inittooltip();
		<?php
		if($i!=-1){ ?>
		$('.collect').removeClass('hide');
		$('.decollect').addClass('hide');
		<?php
		}else{ ?>
		$('.decollect').removeClass('hide');
		$('.collect').addClass('hide');
		<?php }
		?>
	});
	<?php } ?>
</script>