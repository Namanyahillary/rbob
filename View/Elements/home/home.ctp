<body id="home" data-spy="scroll" data-target="#primary-nav" style="position: fixed; width: 100%; height: 100% !important;">
	<div id="container">
	
		<?php echo $this->element('home/home_top_nav_login'); ?>
		<div style="margin-top:-12%;">
		<?php echo $this->element('home/home_teaser'); ?>
		</div>
		
		<div id="content" class="container">
			
		</div>
		<div id="footer">
			<?php //echo $this->element('home/home_footer'); ?>
		</div>
	</div>
	<!--
	<div class="logo" style="position: fixed;top: 0;z-index: 1030;">
		<img src="<?php echo $this->webroot; ?>img/logo.png" alt="" />
	</div>
	-->
	
	<center>
		<div class="logo" style="position: fixed;left: 10px;bottom: 0;width:100%">			
			<p>
			<br/><br/>
				<?php echo $this->element('home/home_footer'); ?>
			</p>
			
		</div>
	</center>
</body>