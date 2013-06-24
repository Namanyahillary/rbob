<?php echo $this->Html->script(array('jquery.nivo.slider.pack'));?>
<?php echo $this->Html->css(array('nivo-slider','styles'));?>

<div>
	<?php 
	/*echo $this->Html->image('countries/'.($this->Session->read("RoundBob['Destination']['Country']")).'.png',array(
	'style'=>'width:100%;height:300px;border-radius:10px;border:2px solid #cfcfcf;'
	)); 
	*/
	?>
</div>

<div id="wrap">		
	<div class="razd_bor"></div>
	<div class="prew_box prew_bg1">					
		<div id="slider-wrapper">        
			<div id="slider" class="nivoSlider">
				<a href="" class="no-ajax"><?php echo $this->Html->image('countries/images/prev_bg_1.jpg',array('style'=>'width:100%;height:300px;border-radius:10px;border:2px solid #cfcfcf;')); ?></a>
				<?php echo $this->Html->image('countries/images/prev_bg_2.jpg',array('style'=>'width:100%;height:300px;border-radius:10px;border:2px solid #cfcfcf;')); ?>
				<?php echo $this->Html->image('countries/images/prev_bg_3.jpg',array('style'=>'width:100%;height:300px;border-radius:10px;border:2px solid #cfcfcf;')); ?>
				<?php echo $this->Html->image('countries/images/prev_bg_4.jpg',array('style'=>'width:100%;height:300px;border-radius:10px;border:2px solid #cfcfcf;')); ?>
				<?php echo $this->Html->image('countries/images/prev_bg_5.jpg',array('style'=>'width:100%;height:300px;border-radius:10px;border:2px solid #cfcfcf;')); ?>
				<!--<img src="images/prev_bg_1.jpg" alt="" />
				<img src="images/prev_bg_2.jpg" alt=""/>
				<img src="images/prev_bg_3.jpg" alt="" />
				<img src="images/prev_bg_4.jpg" alt="" />
				<img src="images/prev_bg_5.jpg" alt="" />-->
			</div>	
		</div>
	</div>			
</div>

<script type="text/javascript">
	$(window).load(function() {
		$('#slider').nivoSlider();
	});
</script>