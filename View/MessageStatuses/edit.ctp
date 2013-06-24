<div class="messageStatuses form">
<?php echo $this->Form->create('MessageStatus'); ?>
	<fieldset>
		<legend><?php echo __('Edit Message Status'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MessageStatus.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('MessageStatus.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Message Statuses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Messages'), array('controller' => 'messages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Message'), array('controller' => 'messages', 'action' => 'add')); ?> </li>
	</ul>
</div>
