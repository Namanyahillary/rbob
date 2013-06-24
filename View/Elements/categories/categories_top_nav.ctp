<div id="user-nav" class="navbar navbar-inverse">
	<ul class="nav btn-group" style="width: auto; margin: 0px;">
		<?php if($logged_in):?>
		<li style="margin-top:-4px;">
			<?php echo $this->Element('Notifications.NotificationInit'); ?>
			<?php echo $this->Element('Notifications.NotificationIcon'); ?>
			<?php /*echo $this->Element('Notifications.NotificationIcon', array(
								'all_notifications' => array('controller' => 'dashboard', 'action' => 'notifications'),
								'clear_notifications' => true,
					)); */
			?>
		</li>
		<li class="btn btn-inverse"><a class="tip-bottom use-ajax" data-original-title="my profile" href="<?php echo $this->params->webroot.'users/view/'.($users_Id) ?>"><i class="icon icon-user"></i> <span class="text">Profile</span></a></li>
		<!--<li class="btn btn-inverse dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Messages</span> <span class="label label-important message-count">5</span> <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li><a href="<?php echo $this->params->webroot.'messages/add'; ?>" class="for-modal use-ajax"><i class="icon icon-plus-sign"></i> new Message</a></li>
				<li><a href="<?php echo $this->params->webroot.'messages/index'; ?>" class="use-ajax"><i class="icon icon-inbox"></i> inbox</a></li>
			</ul>
		</li>-->
		<li class="btn btn-inverse"><a class="tip-bottom use-ajax" data-original-title="my settings" href="<?php echo $this->params->webroot.'users/settings/'.($users_Id) ?>"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
		<?php endif; ?>		
	</ul>
</div>

<?php

?>