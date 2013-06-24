<?php echo $this->Html->css(array('style_login'));?>
<div class="container-fluid">
<div class="row-fluid">
			
	<div class="row-fluid">
		<div style="position:absolute;float:left;z-index:-1;margin-top:8%;">
			<?php echo $this->Html->image('/img/bg_login1.png',array()); ?>
		</div>
		<div class="login-box" style="float:right;">
			<div class="icons">
				<a href="<?php echo $this->params->webroot; ?>"><i class="icon-home"></i></a>
				<a href="#"><i class="icon-cog"></i></a>
			</div>
			<h2>Login to your account</h2>
			<div class="flash-message">
				<?php //echo $this->Session->flash('auth');?>
				<?php //echo $this->Session->flash(); ?>
			</div>
			<?php echo $this->Form->create('User', array('action'=>'login','class'=>'no-ajax')); ?>				
				<fieldset>
					<label style="margin-left:3%">Username:</label>
					<div class="input-prepend" title="Username">
						<span class="add-on"><i class="icon-user"></i></span>							
						<input class="input-large span10" name="data[User][username]" id="username" type="text" placeholder="type username" required=''>
					</div>
					<div class="clearfix"></div>
					
					<label style="margin-left:3%">Password:</label>
					<div class="input-prepend" title="Password">							
						<span class="add-on"><i class="icon-lock"></i></span>
						<input class="input-large span10" name="data[User][password]" id="password" type="password" placeholder="type password" required=''>
					</div>
					<div class="button-login">	
						<button type="submit" class="btn btn-primary"><i class="icon-off icon-white"></i> Login</button>
					</div>
					<div class="clearfix"></div>
			
			<hr>
			<?php echo $this->Html->Link("Sign up",array('controller'=>'users','action'=>'register'),array('class'=>'btn btn-success')); ?>
			<div style="float:right;">
				<h3>Forgot Password? </h3>
				<p><?php echo $this->Html->Link("click here",array('controller'=>'users','action'=>'reset_password')); ?> to get a new password.</p>
			</div>
		</fieldset></form></div><!--/span-->
	</div><!--/row-->
	
		</div><!--/fluid-row-->
		
</div><!--/.fluid-container-->