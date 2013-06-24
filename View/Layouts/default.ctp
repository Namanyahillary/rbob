<!DOCTYPE html>
<html lang="en" style="height: 332px; <?php if(($this->params->url!='pages/home' && $this->params->url!='' && $this->params->url!='users/login' && $this->params->url!='users/logout' && $this->params->url!='users/register' && $this->params->url!='users/reset_password')){echo 'margin-top: 34px !important;';}?>" toolbar_fixed="1">
<head>
	<?php echo $this->Html->script('required_script'); ?>
	<?php echo $this->Html->charset(); ?>
	
	<title>
		<?php echo __('RoundBob'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('bootstrap.min','bootstrap-responsive.min','img_style'));
		echo $this->Html->script(array('jquery.min','scroll','pirobox_extended_1.3'));
		if($this->params->url=='pages/home' || $this->params->url==''){
			echo $this->Html->css(array('about','animate','style','fancybox/jquery_fancybox_pack'));
			echo $this->Html->script(array('bootstrap.min','jquery.anchor','fancybox/jquery_fancybox_pack','script'));
		}else{
			echo $this->Html->css(array('unicorn.main','cake.generic',
					'select2','unicorn.bob'));			
			echo $this->Html->css('/notifications/css/notifications'); 
			
			echo $this->Html->script(array('excanvas.min','jquery.ui.custom','bootstrap.min',
										'jquery.peity.min','unicorn','bootstrap-tab'));
			echo $this->Html->script('/notifications/js/notifications'); 
		}
		
		//skins
		if($this->params->url=='categories'){
			echo $this->Html->css('unicorn.bob', null, array('class' => 'skin-color'));
		}else if(!($this->params->url=='pages/home' || $this->params->url=='')){
			echo $this->Html->css('unicorn.bob', null, array('class' => 'skin-color'));
		}
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>

<!--Body-->

<?php if($this->params->url=='pages/home' || $this->params->url=='')://If this is lauched as a home page ?>
	<?php echo $this->element('home/home'); ?>
	
<?php elseif(($this->params->url=='users/login' || $this->params->url=='users/logout')): ?>
	<?php echo $this->element('login/login'); ?>
	
<?php elseif(($this->params->url=='users/register')): ?>
	<?php echo $this->element('login/register'); ?>

<?php elseif(($this->params->url=='users/reset_password')): ?>
	<?php echo $this->element('login/reset_password'); ?>

<?php elseif($this->params->url=='categories' or !($admin || $bank_admin || $super_admin)): ?>
		<?php echo $this->element('categories/categories'); ?>
<?php else: ?>
		<?php echo $this->element('dashboard/dashboard'); ?>
<?php endif; ?>

</html>
