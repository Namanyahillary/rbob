<div class="messages form">
<?php echo $this->Form->create('Message'); ?>
	<fieldset>
		<legend><?php echo __('Edit Message'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('to');
		echo $this->Form->input('user_id');
		echo $this->Form->input('message_subject');
		echo $this->Form->input('message_body');
		echo $this->Form->input('message_status_id');
		echo $this->Form->input('message_date');
		echo $this->Form->input('message_kind_id');
		echo $this->Form->input('filename');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Message.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Message.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Messages'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Message Statuses'), array('controller' => 'message_statuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Message Status'), array('controller' => 'message_statuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Message Kinds'), array('controller' => 'message_kinds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Message Kind'), array('controller' => 'message_kinds', 'action' => 'add')); ?> </li>
	</ul>
</div>
