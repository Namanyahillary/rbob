<?php echo $this->Html->css(array('style_register'));?>
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
			<h2>Registration</h2>
			
			<div class="flash-message">
				<span style="margin-left:7%;color:green"><b>NB:You will be prompted to login after a Success registration.</b></span>
				<?php echo $this->Session->flash('auth');?>
				<?php echo $this->Session->flash(); ?>
			</div>
			<?php echo $this->Form->create('User', array('action'=>'register')); ?>				
				<fieldset>
					<?php
						echo $this->Form->input('name');
						echo $this->Form->input('email');
						echo $this->Form->input('username');
						echo $this->Form->input('password');
						echo $this->Form->input('password_confirmation',array('type'=>'password'));
						if($admin){
							echo $this->Form->input('role',array('type'=>'select','options'=>array('regular'=>'Regular user','admin'=>'Administrator'),'class'=>'role'));
						}
					?>
					<button type="submit" class="btn btn-success"><i class="icon-ok icon-white"></i> submit</button><hr/>
			<div style="float:right;">
				<a href="<?php echo $this->params->webroot.'users/login'; ?>" class="btn btn-primary"><i class="icon-off icon-white"></i> Login</a>
			</div>
			<div style="float:right;">
				<h3>Forgot Password? </h3><hr/>
				<p><?php echo $this->Html->Link("click here",array('controller'=>'users','action'=>'reset_password')); ?> to get a new password.</p>
			</div>
		</fieldset></form></div><!--/span-->
	</div><!--/row-->
	
		</div><!--/fluid-row-->
		
</div><!--/.fluid-container-->
<div class="logo" style="position: fixed;left: 10px;bottom: 0;width:100%">
	<p>
		<?php echo $this->element('home/home_footer'); ?>
	</p>		
</div>