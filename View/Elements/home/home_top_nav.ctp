<?php
	$url='';
	$is_home=1;
	if(!(($this->params->url=='pages/home') || ($this->params->url==''))){
		$url=$this->params->webroot.'categories';
		$is_home=0;
	}
?>

<div class="navbar navbar-inverse navbar-fixed-top" fixed_managed="1" style="top: 0;">
<div class="navbar-inner">
  <div class="container">
	<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">Menu</a>
	<a class="brand" href="<?php echo $url; ?>"><?php echo $this->Html->image('logo.png',array('width'=>'35px','style'=>'width:35px')); ?></a>
	<div id="primary-nav" class="nav-collapse">
	  <ul class="nav">
		<li class="<?php if($is_home) echo ''; ?>"><a class="anchorLink no-ajax" href="<?php echo $url; ?>"><i class="icon-white icon-home"></i> Home</a></li>
		<?php if($admin || $bank_admin || $super_admin):?>
			<li class="active1"><a href="<?php echo $this->params->webroot; ?>dashboards">Admin</a></li>
		<?php endif;?>
		<!--<li class="active1"><a href="<?php echo $this->params->webroot; ?>categories">Destinations</a></li>-->
	  </ul>
	  <ul class="nav pull-right">
		<?php if($logged_in): ?>
			<li>
				<a style="margin-top:5px;" class="use-ajax" href="<?php echo $this->params->webroot.'users/view/'.($users_Id);?>">
					<img src="<?php echo $this->params->webroot.'img/pic/'.$profile_image;?>" width="20px" style="border-radius:4px;width:20px;"  />
					<?php echo $name_of_user; ?>
				</a>
			</li>
		<?php endif; ?>
		
		<li><a style="margin-top:5px;" href="<?php echo $this->params->webroot.'users/'.( ($logged_in)? 'logout':'login'); ?>"><i class="icon-white icon-off"></i> <span class="text">
			<?php echo ($logged_in)? "Logout":"Login" ?>
		</span></a></li>
		
		<?php if(!$logged_in): ?>
			<li><a style="margin-top:5px;" href="<?php echo $this->params->webroot.'users/register'; ?>"><span class="text">
				SignUp
			</span> <i class="icon-white icon-share-alt"></i></a></li>
		<?php endif; ?>
		
	  </ul>
	</div><!--/.nav-collapse -->
  </div><!--/container-->
</div><!--/navbar-inner-->
</div><!--/navbar-->