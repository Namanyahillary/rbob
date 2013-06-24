<?php echo $this->Html->css(array('nivo-slider'));?>
<div id="wrap">		
	<div class="razd_bor"></div>
	<div class="prew_box prew_bg1">					
		<div id="slider-wrapper">        
			<div id="slider" class="nivoSlider">
				<img src="img/images/prev_bg_1.jpg" alt="" />
				<img src="img/images/prev_bg_2.jpg" alt=""/>
				<img src="img/images/prev_bg_3.jpg" alt="" />
				<img src="img/images/prev_bg_4.jpg" alt="" />
				<img src="img/images/prev_bg_5.jpg" alt="" />
			</div>			        
		</div>
		
		<div id="slider-wrapper">        
			<div id="slider" class="nivoSlider">
				<img src="img/images/prev_bg_1.jpg" alt="" />
				<img src="img/images/prev_bg_2.jpg" alt=""/>
				<img src="img/images/prev_bg_3.jpg" alt="" />
				<img src="img/images/prev_bg_4.jpg" alt="" />
				<img src="img/images/prev_bg_5.jpg" alt="" />
			</div>			        
		</div>

		<?php echo $this->Html->script(array('jquery.nivo.slider.pack'));?>
		
		<script type="text/javascript">
			$(window).load(function() {
				$('#slider').nivoSlider();
			});
		</script>
	</div>			
</div>