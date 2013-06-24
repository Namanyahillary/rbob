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
	<!--<a class="brand" href="index.html"><?php echo $this->Html->image('logo.png',array('width'=>'35px')); ?></a>-->
	<div id="primary-nav" class="nav-collapse">
	  <ul class="nav">
		<!--<li class="<?php if($is_home) echo ''; ?>"><a class="anchorLink" href="<?php echo $url; ?>#">Roundbob</a></li>-->
		<?php if($admin || $bank_admin || $super_admin):?>
			<li class="active1"><a href="<?php echo $this->params->webroot; ?>dashboards">Admin</a></li>
		<?php endif;?>
		
	  </ul>
	  <ul class="nav pull-right">
		<?php if(!$logged_in): ?>
		<li class="active1"><a href="#"></a>
			<div>
				<form action="<?php echo $this->webroot.'users/login';?>" style="margin:-12px 0px 0px 0px;" id="UserLoginForm" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
				<span style="color:#fff;">Username</span> <input style="height:13px;" type="text" name="data[User][username]" required="" placeholder="Enter username" /> 
				<span style="color:#fff;">Password</span> <input style="height:13px;" type="password" name="data[User][password]" required="" placeholder="Enter password" />
				<button style="margin-top:-7px;" type="submit" class="btn btn-success"><i class="icon-off icon-white"></i> Login</button>
				</form>
			</div>
		</li>
		
		<?php endif; ?>
		<?php if($logged_in): ?>
			<li>
				<a style="margin-top:5px;" class="no-ajax" href="<?php echo $this->params->webroot.'users/view/'.($users_Id);?>">
					<img src="<?php echo $this->params->webroot.'img/pic/'.$profile_image;?>" width="20px" style="border-radius:4px;"  />
					<?php echo $name_of_user; ?>
				</a>
			</li>		
		<li><a class="no-ajax" style="margin-top:5px;" href="<?php echo $this->params->webroot.'users/'.( ($logged_in)? 'logout':'login'); ?>"><i class="icon-white icon-off"></i> <span class="text">
			<?php echo ($logged_in)? "Logout":"Login" ?>
		</span></a></li>
		<?php endif; ?>
		
	  </ul>
	</div><!--/.nav-collapse -->
  </div><!--/container-->
</div><!--/navbar-inner-->
</div><!--/navbar-->