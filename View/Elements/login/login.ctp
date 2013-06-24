	<style type="text/css">
	<!--
	body { 
		padding-top: 60px;
		padding-bottom: 0;
		font-weight: 400;
		font-family: 'Ubuntu', sans-serif;
		background: #f1f2f3 url("<?php echo $this->webroot;?>img/standard-bg.png") center top no-repeat;
		filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='assets/header-bg-3.jpg', sizingMethod='scale');
		-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='assets/header-bg-3.jpg', sizingMethod='scale')";
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-position: fixed;

	}
	.login-box {
		width: 400px;
		margin: 100px auto;
		margin-top:0%;
		background: rgb(245,245,245); /* Old browsers */
		background: -ms-linear-gradient(top,  rgba(245,245,245,1) 0%,rgba(255,255,255,1) 19%,rgba(255,255,255,1) 77%,rgba(245,245,245,1) 100%); /* IE10+ */
		background: linear-gradient(to bottom,  rgba(245,245,245,1) 0%,rgba(255,255,255,1) 19%,rgba(255,255,255,1) 77%,rgba(245,245,245,1) 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f5f5f5', endColorstr='#f5f5f5',GradientType=0 ); /* IE6-8 */
		color: #000;
		overflow: hidden;
		-webkit-border-radius: 2px;
		   -moz-border-radius: 2px;
				border-radius: 2px;
		-webkit-box-shadow: 0px 0px 0px 5px rgba(0,0,0,0.15);
		   -moz-box-shadow: 0px 0px 0px 5px rgba(0,0,0,0.15);
				box-shadow: 0px 0px 0px 5px rgba(0,0,0,0.15);
	}

	.login-box .icons {
		text-align: right;
		margin: 5px 15px;
		
	}

	.login-box .icons i {
		text-align: right;
		opacity: .2;
		margin: 0px 5px;
	}

	.login-box .icons i:hover {
		opacity: .8;
	}

	.login-box h2 {
		color: #646464;
		margin-left: 30px;
		font-family: monaco;
		font-weight: normal;
	}

	.login-box h3 {
		color: #646464;
		margin-left: 30px;
		font-family: monaco;
		font-weight: normal;
	}

	.login-box p {
		margin: 10px 30px;
		font-weight: normal;
	}

	.login-box .input-prepend {
		background: #fff;
		width: 100%;
		text-align: center;
		border-left: 3px solid #fff;
	}

	.login-box .input-prepend-focus {
		background: #fcfcfc;
		width: 100%;
		text-align: center;
		border-left: 3px solid #646464;
	}

	.login-box .add-on {
		border: 1px solid #eee !important;
		background: #fff;
		margin-left: -10px;
		padding: 10px;
	}

	.login-box .add-on i{
		opacity: .1;
	}

	.login-box input[type="text"],
	.login-box input[type="password"] {
		border: 1px solid #eee !important;
		color: #aaa;
		border-left: none !important;
		-webkit-box-shadow: none;
		   -moz-box-shadow: none;
				box-shadow: none;
		height: 42px !important;		
	}

	.login-box .remember {
		margin-top: 20px;
		margin-left: 20px;
		float: left;
	}

	.login-box .button-login {
		margin-top: 20px;
		margin-right: 20px;
		float: right;
	}
	-->
</style>

<body style="background-color: #f1f2f3;">
	<div class="container-fluid">
	<div class="row-fluid">
				
		<div class="row-fluid">
			<div style="position:absolute;float:left;z-index:-1;margin-top:8%;">
				<?php echo $this->Html->image('/img/bg_login1.png',array()); ?>
			</div>
			<div class="login-box" style="float:right;">
				<div class="icons">
					<a href="index.html"><i class="icon-home"></i></a>
					<a href="#"><i class="icon-cog"></i></a>
				</div>
				<h2>Login to your account</h2>
				<div class="flash-message">
					<?php echo $this->Session->flash('auth');?>
					<?php echo $this->Session->flash(); ?>
				</div>
				<?php echo $this->Form->create('User', array('action'=>'login')); ?>				
					<fieldset>
						<label style="margin-left:3%">Username:</label>
						<div class="input-prepend" title="Username">
							<span class="add-on"><i class="icon-user"></i></span>							
							<input class="input-large span10" name="data[User][username]" id="username" type="text" placeholder="type username">
						</div>
						<div class="clearfix"></div>
						
						<label style="margin-left:3%">Password:</label>
						<div class="input-prepend" title="Password">							
							<span class="add-on"><i class="icon-lock"></i></span>
							<input class="input-large span10" name="data[User][password]" id="password" type="password" placeholder="type password">
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

<center>
	<div class="logo" style="position: fixed;left: 10px;bottom: 0;width:100%">
		<p>
			<?php echo $this->element('home/home_footer'); ?>
		</p>		
	</div>
</center>
</body>