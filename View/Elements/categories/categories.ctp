<?php
	$_currency=($this->Session->read("RoundBob['Destination']['Currency']"));
?>
<script>
allow_get=false;
</script>
<?php
		echo $this->Html->css('style_login_categories');
?>
<body style="position: absolute; width: 100%; margin-top: 35px; height: auto !important;">
	<div id="container">
		<div id="header">
			<h1><a href="#">Admin</a></h1>		
		</div>
	
			<?php echo $this->element('home/home_top_nav'); ?>
			<?php echo $this->element('categories/categories_search'); ?>	
			<?php echo $this->element('categories/categories_top_nav'); ?>
			<?php echo $this->element('categories/categories_sidebar'); ?>
			<?php //echo $this->element('categories/categories_style_switcher'); ?>
		
		<div id="content">			
			<div class="container-fluid">
				
				<div class="change-links">
				<?php
					if($this->Session->read("RoundBob['Destination']['CountryName']")){
						echo "<br/><b><span style='font-size:15px;font-weight:bold;color:green;'> ".($this->Session->read("RoundBob['Destination']['CountryName']")."</span>".('<a style="float:right;" class="btn btn-small" href="'.$this->webroot.'">Change Country</a>'))."</b>";
					}	
				?>
				
				<!--<span class="btn btn-small" style="float:right;">Currency</span>-->
				<div class="btn-group" style="float:right;">
					<button class="btn btn-small dropdown-toggle" data-toggle="dropdown">
					  <b>currency (<?php echo $_currency['Currency']['short_code'];?>)</b>
					  <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<?php foreach($available_currencies as $currency):?>
							<li><a title="<?php echo $currency['Currency']['name'];?>" href="<?php echo $this->webroot;?>dashboards/change_currency/<?php echo $currency['Currency']['id'];?>" class="no-ajax" ><?php echo $currency['Currency']['short_code'];?></a></li>
						<?php endforeach;?>
					</ul>
				</div>
				</div>
			
				<div class="row-fluid dynamic-content" >
					<?php echo $this->Session->flash(); ?>
					
						<?php if($this->params->url!='users/login' || $this->params->url!='users/register'): ?>
							<?php echo $this->Html->script(array('script_dynamic_content','script_static_content'));?>
							<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
						<?php endif; ?>
						
					<?php echo $this->fetch('content'); ?>
			
				</div>
			
				<div class="row-fluid">
					<div id="footer" style="float:left;">					
							<?php echo $this->element('home/home_footer'); ?>
					</div>
				</div>
				
			</div>
		</div>
		
		<div id="footer">
		</div>
	</div>
	
	
	<?php echo $this->Html->script('required_script_bottom'); ?>
</body>

<div id="view-modal" style="width:50% !important;" class="modal hide fade">
	         
	<div class="modal-body">	
	
	</div>            
</div>
<?php if($this->params->url!='users/login'): ?>
<script>
	$(document).ready(function(){
		/*$.get('<?php echo $this->webroot;?>destinations_regions',function(data){
			$('.dynamic-content').html(data);
		});*/
	});
</script>
<?php endif; ?>