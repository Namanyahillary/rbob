<?php echo $this->Html->script(array('script_dynamic_content'));?>
<div class="flash-message"><?php echo $this->Session->flash(); ?></div>
<?php echo $this->Element('Notifications.NotificationList', array('notifications' => $result)); ?>