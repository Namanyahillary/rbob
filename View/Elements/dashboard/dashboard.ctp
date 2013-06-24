<script>
allow_get=true;
</script>
<?php if($logged_in):?>
<body style="position: absolute; width: 100%; margin-top: 35px; height: auto !important;">
	<div id="container">
		<div id="header">
			<h1><a href="#">Roundbobd</a></h1>		
		</div>

<?php endif; ?>		
			<?php echo $this->element('home/home_top_nav'); ?>
<?php if($logged_in):?>
			<?php echo $this->element('dashboard/dashboard_top_nav'); ?>
			<?php if($regular){
				echo $this->element('categories/categories_search'); 
			}else{
				echo $this->element('dashboard/dashboard_search');			
			}
			?>
			
			<?php echo $this->element('dashboard/dashboard_sidebar'); ?>
		
		<div id="content">
			<div id="content-header">
				<h1><a class="brand" href="index.html"><?php echo $this->Html->image('logo.png',array('width'=>'35px')); ?></a><b>Roundbob</b></h1>
				<?php if($logged_in):?>
					<?php echo $this->element('dashboard/dashboard_utilities'); ?>
				<?php endif; ?>
			</div>
			
			<div id="breadcrumb">
				<a href="<?php echo $this->params->webroot; ?>pages/home" class="tip-bottom" data-original-title="Go to Home"><i class="icon-home"></i>Home</a>
				<a class="current"><?php echo $this->params->controller; ?></a>
			</div>
			<div class="container-fluid">
				
				<div class="row-fluid dynamic-content" >
					<?php echo $this->Session->flash(); ?>
					
					
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
	<div class="modal-header">
	  <button class="close" data-dismiss="modal">&times;</button>	  
	</div>          
	<div class="modal-body">	
	
	</div>            
</div>